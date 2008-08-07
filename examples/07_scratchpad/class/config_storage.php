<?

class Config_Storage {

    protected static $db;
    
    const filename = 'config.db';
    
    public function load( Config $c ){
        $db = $this->db();
        $st = $db->prepare('SELECT * FROM config');
        $rs = $st->execute();
        if( ! $rs ) throw $this->databaseException($st);
        while( $row = $st->fetch(PDO::FETCH_ASSOC)){
            $k = $row['k'];
            $v = $row['v'];
            $c->$k = $v;
        }
    }
    
    public function store( Config $c ){
        $db = $this->db();
        try {
            $db->beginTransaction();
            $st = $db->prepare('DELETE FROM config');
            $st->execute();
            $st = $db->prepare("INSERT OR REPLACE INTO config (k, v) VALUES (?, ?)");
            foreach( $c as $k=>$v) $st->execute(array($k, $v));
            $db->commit();
        } catch( Exception $e){
            $db->rollback();
            throw $e;
        }
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/
    
    protected function db(){
        if( isset( self::$db ) ) return self::$db;
        $db = new PDO('sqlite2:' . ROOT_DIR . 'db' . DIRECTORY_SEPARATOR. self::filename, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
}
// EOF