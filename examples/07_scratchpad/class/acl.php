<?
class ACL extends Grok {

    const filename = 'permission.db';
    
    protected static $db;
    
    protected $area = '';
    
    public function __construct( $area ){
        $this->area = $area = $this->__normalize( $area );
        if( strlen( $area ) > 32 ) $area = md5(32);
        $db = $this->db();
        $st = $db->prepare("SELECT role, action FROM acl WHERE area = ?");
        $st->execute(array($area));
        $roles = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC)){
            if( ! isset( $roles[ $row['role'] ] ) )  $roles[ $row['role'] ]= array();
             $roles[ $row['role'] ][] = $row['action'];
        }
        $st->closeCursor();
        foreach( $roles as $role=>$actions ) $this->$role = $actions;
    }
    
    public function __destruct(){
    
    }
    
    protected function store(){
        $area = $this->area;
        if( strlen( $area ) > 32 ) $area = md5(32);
        $db = $this->db();
        $db->beginTransaction();
        $st = $db->prepare('DELETE FROM acl WHERE area = ?');
        $st->execute( array( $this->area ) );
        $st = $db->prepare('INSERT INTO acl (area, role, action) VALUES (:area, :role, :action)');
        foreach( $this as $role=>$actions ){
            foreach( $actions as $action ){
                $st->execute(array('area'=>$area, 'role'=>$role, 'action'=>$action) );
            }
        }
        $db->commit();
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
    
    protected function db(){
        if( isset( self::$db ) ) return self::$db;
        $db = new PDO('sqlite2:' . ROOT_DIR . 'db' . DIRECTORY_SEPARATOR . self::filename, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
}