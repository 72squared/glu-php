<?
class ACL_Areas extends Grok {

    const filename = 'permission.db';
    
    private static $db;
    
    public function __construct( $data = NULL ){
        $this->load();
        parent::__construct( $data );
    }
   
    public function initialize(){
        $db = $this->db();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $db->query('DROP TABLE acl_areas');
        $db->query('CREATE TABLE acl_areas (area_id INTEGER PRIMARY KEY, area TEXT(32) UNIQUE)');
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