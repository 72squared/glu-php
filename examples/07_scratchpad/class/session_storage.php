<?

class Session_Storage {

    protected static $db;
        
    const filename = 'session.db';
    
    protected static $columns = array('session_id', 'token', 'created', 'modified');
    
    public function load( Session $s ){
        $this->loadBySessionId( $s );
        $this->loadByToken( $s );
    }
    
    public function store( Session $s ){
        if( ! $s->token ) throw new Exception('invalid-token');
        $s->modified = $this->now();
        if( ! $s->created ) $s->created = $this->now();
        $db = $this->db();
        $params = array();
        $data = array();
        foreach($s as $k=>$v){
            if( in_array($k, self::$columns) ){
                $params[$k] = $v;
            } else {
                $data[$k] = $v;
            }
        }
        $params['data'] = $this->encode($data);
        
        if( $s->session_id ) {
            $st = $db->prepare("INSERT OR REPLACE INTO session (session_id, token, data, created, modified) VALUES (:session_id, :token, :data, :created, :modified)");
            $st->execute($params);
            return;
        }
        unset( $params['session_id'] );
        $st = $db->prepare("INSERT OR REPLACE INTO session (token, data, created, modified) VALUES (:token, :data, :created, :modified)");
        $st->execute( $params );
        $s->session_id = $db->lastInsertId();
    }
    
    public function gc(){
        $now = $this->now();
        $expire = $now - 3600;
        $db = $this->db();
        $st = $db->prepare('SELECT session_id FROM session WHERE modified < ? LIMIT 1000');
        $st->execute( array($expire ) );
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC)){
            $ids[] = $row['session_id'];
        }
        $st->closeCursor();
        if( count( $ids ) < 1 ) return;
        $st = $db->query(sprintf('DELETE FROM session WHERE session_id IN (%s)', implode(',', $ids)));
    }
    
    public function __destruct(){
        if( mt_rand(0, 1000) == 1 ) $this->gc();
    }
    /*** PROTECTED FUNCTIONS BELOW ***/
   
    protected function loadBySessionID( Session $s ){
        if( ! isset( $s->session_id )) return;
        if( isset( $s->token ) ) return;
        $db = $this->db();
        $st = $db->prepare('SELECT * FROM session WHERE session_id = ?');
        $st->execute( array($s->session_id ) );
        $data = $this->loadData( $s, $st->fetch(PDO::FETCH_ASSOC));
        $st->closeCursor();
        return $data;
    }
    
        
    protected function loadByToken( Session $s ){
        if( ! isset( $s->token )) return;
        if( isset( $s->session_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM session WHERE token = ?");
        $st->execute( array( $s->token ) );
        $data = $this->loadData( $s, $st->fetch(PDO::FETCH_ASSOC));
        $st->closeCursor();
        return $data;
    }
    
    protected function loadData( Session $s, $data ){
        if( ! is_array( $data ) || 
            ! isset( $data['modified'] ) || 
            $data['modified'] + 3600 < $this->now() ) {
            unset( $s->session_id );
            return;
        }
        $extra = $this->decode( $data['data']);
        unset( $data['data']);
        foreach( $data as $k=>$v) $s->$k = $v;
        foreach( $extra as $k=>$v) $s->$k = $v;
    }
    
    public function now(){
        return time();
    }
    
    protected function encode($v){
        if( ! is_array( $v ) ) $v = array();
        if( empty( $v ) ) return '';
        return @json_encode($v);
    }
    
    protected function decode($v){
        $v = json_decode($v);
        if( ! is_array( $v ) && ! ($v instanceof stdclass) ) $v = array();
        return $v;
    }
    
    protected function db(){
        if( isset( self::$db ) ) return self::$db;
        $db = new PDO('sqlite2:' . ROOT_DIR . 'db' . DIRECTORY_SEPARATOR . self::filename, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
}
//EOF