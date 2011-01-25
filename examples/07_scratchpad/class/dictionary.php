<?
class Dictionary extends GLU {
    protected static $db;

    
    public function __construct( $words = NULL ){
        
        
        
        
        
        
        parent::__set($word, $id );
    }
    
    public function __set( $word, $id ){
      
    }
    
    
    protected function db(){
        if( isset( self::$db ) ) return self::$db;
        $path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . strtolower( __CLASS__) . '.db';
        $db = new PDO('sqlite2:' . $path, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
    
    protected function checksum(){
        return md5(strval($this));
    }
    
    protected function now(){
        return time();
    }
    
}