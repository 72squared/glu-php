<?
class Permission extends GLU {

    protected $role = '';
    
    const filename = 'permission.db';
    
    private static $db;
    
    public function __construct( $role = NULL, $data = NULL){
        if( $role instanceof User ){
            $user = $role;
            $role = $user->role;
            if( ! $role ){
                $role = ( $user->user_id ) ? 'user' : 'guest';
            }
            if( $user->user_id == 1 ){
                $data = array('/'=>array('read','write','comment', 'manage'));
            }
        }
    
        
        $this->role = $this->normalizeRole( $role );
        if( is_array( $data ) ) {
            parent::__construct( $data );
            $this->ksort();
            return;
        }
        if( strlen( $this->role ) < 1 ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT path, action FROM access WHERE role = ?");
        try {
            $st->execute(array($role));
        } catch( PDOException $e ){
            $msg =  $e->getMessage();
            if( strpos($e, 'no such table') === FALSE ) throw $e;
            $this->initialize();
            $st->execute(array($role));
        }
        
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC)){
            if( ! isset( $paths[ $row['path'] ] ) )  $paths[ $row['path'] ]= array();
             $paths[ $row['path'] ][] = $row['action'];
        }
        $st->closeCursor();
        foreach( $paths as $path=>$actions ) $this->$path = $actions;
        $this->ksort();
    }
    
    public function store(){
        $db = $this->db();
        $db->beginTransaction();
        $st = $db->prepare('DELETE FROM access WHERE role = ?');
        $st->execute( array( $this->role ) );
        $st = $db->prepare('INSERT INTO access (role, path, action) VALUES (:role, :path, :action)');
        foreach( $this as $path=>$actions ){
            foreach( $actions as $action ){
                $st->execute( array('role'=>$this->role, 'path'=>$path, 'action'=>$action) );
            }
        }
        $db->commit();
    }
    
    public function name(){
        return $this->role;
    }
    
    public static function __list( Permission_Lister $lister ){
        $db = self::db();
        $st = $db->prepare('SELECT * FROM access');
        $st->execute();
        $roles = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ){
            $path = $row['path'];
            $action = $row['action'];
            $role = $row['role'];
            if( ! isset( $roles[ $role ] ) ) $roles[ $role ] = array();
            if( ! isset( $roles[ $role ][ $path ] ) ) $roles[ $role ][ $path ] = array();
            $roles[ $role ][ $path ][] = $action;
        }
        $st->closeCursor();
        foreach( $roles as $role =>$data ){
            $lister->$role = new self( $role, $data );
        }
    }
    
    public static function paths(){
        $db = self::db();
        $st = $db->prepare('SELECT path FROM access GROUP BY path ORDER BY path ASC');
        $st->execute();
        $list = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $list[] = $row['path'];
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
    
    public function verify( $action, $check_path = '/' ){
        if( $check_path == NULL ) return FALSE;
        $action = $this->normalizeAction( $action );
        $this->ksort();
        foreach( $this as $path=>$actions ){
            if( ! in_array($action, $actions ) ) continue;
            if( strpos( $check_path, $path ) !== FALSE) return TRUE;
        }
        return FALSE;
    }
    
    public function __set( $k, $v ){
        $k = $this->normalizePath( $k );
        if( ! $k ) return;
        $actions = array();
        if( ! is_array($v) && ! $v instanceof iterator ) return array();
        foreach( $v as $a ){
            $a = $this->normalizeAction($a);
            $actions[] = $a;
        }
        if( count( $actions ) < 1 ) {
            $this->__unset( $this->normalizePath($k) );
            return;
        }
        return parent::__set( $this->normalizePath($k), $actions);
    }
    
    
    
    protected function normalizePath( $v ){
        $v = '/' . trim(strval($v), ' /-_');
        if( ! preg_match('#^[\/]?[a-z0-9\/\_\-]+$#i', $v) ) return '/';
        return $v;
    }
    
    protected function normalizeRole( $str ){
        return preg_replace('/[^a-z0-9]/', '', strtolower($str));
    }
    
    
    protected function normalizeAction( $str ){
        return preg_replace('/[^a-z0-9]/', '', strtolower($str));
    }
    
    protected function initialize(){
        $db = $this->db();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $file = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'schema' . DIRECTORY_SEPARATOR . 'permission.sql';
        $queries = explode(";\n", file_get_contents($file));
        foreach( $queries as $sql ) $db->query( $sql );
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