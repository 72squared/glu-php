<?
class ACL extends Grok {

    private $area = '';
    
    private $checksum = '';
    
    const filename = 'permission.db';
    
    private static $db;
    
    public function __construct( $area, $roles = NULL ){
        $this->area = $this->__normalize( $area );
        if( strlen( $this->area ) < 1 ) return;
        $area = ( strlen( $this->area ) > 32 ) ? md5($this->area) : $this->area;
        if( ! is_array( $roles ) ) {
            $db = $this->db();
            $st = $db->prepare("SELECT role, action FROM acl WHERE area = ?");
            $st->execute(array($area));
            $roles = array();
            while( $row = $st->fetch(PDO::FETCH_ASSOC)){
                if( ! isset( $roles[ $row['role'] ] ) )  $roles[ $row['role'] ]= array();
                 $roles[ $row['role'] ][] = $row['action'];
            }
            $st->closeCursor();
        }
        foreach( $roles as $role=>$actions ) $this->$role = $actions;
        $this->checksum = $this->checksum();
    }
    
    public function __destruct(){
        if( $this->checksum == $this->checksum() ) return;
        $area = ( strlen( $this->area ) > 32 ) ? md5($this->area) : $this->area;
        $db = $this->db();
        $db->beginTransaction();
        $st = $db->prepare('DELETE FROM acl WHERE area = ?');
        $st->execute( array( $area ) );
        $st = $db->prepare('INSERT INTO acl (area, role, action) VALUES (:area, :role, :action)');
        foreach( $this as $role=>$actions ){
            foreach( $actions as $action ){
                $st->execute(array('area'=>$area, 'role'=>$role, 'action'=>$action) );
            }
        }
        $db->commit();
        $this->checksum = $this->checksum();
    }
    
    public static function __list( ACL_Lister $lister ){
        $db = self::db();
        $st = $db->prepare('SELECT * FROM acl');
        $st->execute();
        $areas = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ){
            $area = $row['area'];
            $action = $row['action'];
            $role = $row['role'];
            if( ! isset( $areas[ $area ] ) ) $areas[ $area ] = array();
            if( ! isset( $areas[ $area ][ $role ] ) ) $areas[ $area ][ $role ] = array();
            $areas[ $area ][ $role ][] = $action;
        }
        $st->closeCursor();
        foreach( $areas as $area =>$roles ){
            $lister->$area = new ACL( $area, $roles );
        }
    }
    
    
    protected function __call( $action, $args ){
        $action = $this->__normalize( $action );
        $user = new Grok( array_shift($args) );
        foreach( $this as $role=>$actions ){
            if( ! in_array($action, $actions ) ) continue;
            if( $user->$role ) return TRUE;
        }
        return FALSE;
    }
    
    protected function __set( $k, $v ){
        if( ! is_array( $v ) ) $v = array();
        $v = array_values( $v );
        foreach( $v as $a=>$b ) $v[$a] = $this->__normalize($b);
        return parent::__set( $this->__normalize($k), $v );
    }
    
    protected function __normalize( $str ){
        return preg_replace('/[^a-z0-9]/', '', strtolower($str));
    }

    protected function checksum(){
        return md5(strval($this));
    }
    
    protected function initialize(){
        $db = $this->db();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $db->query('DROP TABLE acl');
        $db->query('CREATE TABLE acl (area TEXT(32),role TEXT(32),action TEXT(32),PRIMARY KEY (area, role, action))');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    
    protected function db(){
        if( isset( self::$db ) ) return self::$db;
        $db = new PDO('sqlite2:' . ROOT_DIR . 'db' . DIRECTORY_SEPARATOR . self::filename, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
}