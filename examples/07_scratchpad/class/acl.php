<?
class ACL extends Grok {

    private $area = '';
    
    const filename = 'permission.db';
    
    private static $db;
    
    public function __construct( $area, $roles = NULL ){
        $this->area = $this->normalize( $area );
        
        if( strlen( $this->area ) < 1 ) $this->area = 'default';
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
    }
    
    public function store(){
        $area = ( strlen( $this->area ) > 32 ) ? md5($this->area) : $this->area;
        $db = $this->db();
        $db->beginTransaction();
        $st = $db->prepare('DELETE FROM acl WHERE area = ?');
        $st->execute( array( $area ) );
        $st = $db->prepare('INSERT INTO acl (area, role, action) VALUES (:area, :role, :action)');
        foreach( $this as $role=>$actions ){
            foreach( $actions as $action ){
                $st->execute( array('area'=>$area, 'role'=>$role, 'action'=>$action) );
            }
        }
        $db->commit();
    }
    
    public function name(){
        return $this->area;
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
    
    public static function areas(){
        $db = self::db();
        $st = $db->prepare('SELECT area FROM acl GROUP BY area ORDER BY area ASC');
        $st->execute();
        $list = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $list[] = $row['area'];
        $st->closeCursor();
        return $list;
    }
    
    public static function actions(){
        $db = self::db();
        $st = $db->prepare('SELECT action FROM acl GROUP BY action ORDER BY action ASC');
        $st->execute();
        $list = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $list[] = $row['action'];
        $st->closeCursor();
        return $list;
    }
    
    
    public static function roles(){
        $db = self::db();
        $st = $db->prepare('SELECT role FROM acl GROUP BY role ORDER BY role ASC');
        $st->execute();
        $list = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $list[] = $row['role'];
        $st->closeCursor();
        return $list;
    }
    
    public function verify( User $user, $action ){
        $action = $this->normalize( $action );
        $allow = TRUE;
        foreach( $this as $role=>$actions ){
            if( ! in_array($action, $actions ) ) continue;
            $role = 'acl_' . $role;
            if( $user->$role ) return TRUE;
            $allow = FALSE;
        }
        return $allow;
    }
    
    protected function __set( $k, $v ){
        $k = $this->normalize( $k );
        if( ! $k ) return;
        unset( $this->$k );
        if( ! is_array( $v ) ) $v = array();
        $v = array_values( $v );
        foreach( $v as $a=>$b ){
            $a = $this->normalize( $a );
            $b = $this->normalize( $b );
            if( ! $a ) continue;
            if( ! $b ) continue;
            $v[$a] = $b;
        }
        if( count( $v ) < 1 ) return;
        return parent::__set( $this->normalize($k), $v );
    }
    
    protected function normalize( $str ){
        return preg_replace('/[^a-z0-9]/', '', strtolower($str));
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
        $path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . self::filename;
        $db = new PDO('sqlite2:' . $path, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
}