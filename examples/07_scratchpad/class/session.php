<?php

class Session extends Grok {
    
    private static $db;
    
    private $checksum = '';
    
    const filename = 'session.db';
    
    private static $columns = array('session_id', 'token', 'created', 'modified');
    
    public function __construct( $data = NULL ){
        if( $data === NULL ) $data = $this->cookie();
         if( preg_match("#^[0-9]+$#", $data ) ){
            $this->session_id = $data;
        } elseif( is_scalar( $data ) ){
            $this->token = $data;
        } else {
            parent::__construct($data);
        }
        try {
            $this->loadBySessionId();
            $this->loadByToken();
        } catch( PDOException $e ){
            $msg =  $e->getMessage();
            if( strpos($e, 'no such table') === FALSE ) throw $e;
            $this->initialize();
            $this->loadBySessionId();
            $this->loadByToken();
        }
        
        $this->checksum = $this->checksum();
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/
    
    protected function __set( $k, $v ){
        switch( $k ){
            case 'session_id':         $v = intval($v);
                                    if( $v < 1 ) return NULL;
                                    break;
                                    
            case 'token':           $v = strval($v);
                                    if( ! preg_match('#^[a-z0-9]{32}$#', $v) ) return NULL;
                                    break;
                                    
            case 'created':         if( preg_match("#^[0-9]+$#", $v)) $v = date('Y/m/d H:i:s', $v);
                                    $v = strtotime( $v );
                                    if( ! $v ) return NULL;
                                    
            case 'modified':        if( preg_match("#^[0-9]+$#", $v)) $v = date('Y/m/d H:i:s', $v);
                                    $v = strtotime( $v );
                                    if( ! $v ) return NULL;
                                    
            default:                if( ! preg_match('#[a-z][a-z0-9_]+$#', $k) ) return NULL;
                                    $v = substr(strval($v), 0, 500);
                                    break;
        }
        return parent::__set($k, $v);
    }
    
    public function __destruct(){
        $now = $this->now();
        if( ($this->modified + 10 ) < $now ) $this->modified = $now;
        if( $this->checksum == $this->checksum() ) return;
        $this->store();
        if( mt_rand(0, 3600) == 1) $this->gc();
    }
    
    public function cookie(){
        $cookie_name = 'scratchpad_token';
        if( isset( $_COOKIE[$cookie_name] ) && preg_match('#^[a-z0-9]{32}$#', $_COOKIE[$cookie_name]) ) return $_COOKIE[$cookie_name];
        $charset = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $rand = '';
        $len = strlen($charset ) - 1;
        for ($i=0; $i<32; $i++) $rand .= $charset[(mt_rand(0,$len))];
        $__COOKIE[ $cookie_name ] = $rand;
        setcookie($cookie_name, $rand, 0);
        return $rand;
    }
    
    public function store(){
        if( ! $this->token ) throw new Exception('invalid-token');
        $this->modified = $this->now();
        if( ! $this->created ) $this->created = $this->now();
        $db = $this->db();
        $params = array();
        $data = array();
        foreach($this as $k=>$v){
            if( in_array($k, self::$columns) ){
                $params[$k] = $v;
            } else {
                $data[$k] = $v;
            }
        }
        $params['data'] = $this->encode($data);
        
        if( $this->session_id ) {
            $st = $db->prepare("INSERT OR REPLACE INTO session (session_id, token, data, created, modified) VALUES (:session_id, :token, :data, :created, :modified)");
            $st->execute($params);
            $this->checksum = $this->checksum();
            return;
        }
        unset( $params['session_id'] );
        $st = $db->prepare("INSERT OR REPLACE INTO session (token, data, created, modified) VALUES (:token, :data, :created, :modified)");
        $st->execute( $params );
        $this->session_id = $db->lastInsertId();
        $this->checksum = $this->checksum();
    }
    
    public function gc(){
        $now = $this->now();
        $expire = $now - 3600;
        $db = $this->db();
        $st = $db->prepare('DELETE FROM session WHERE modified < ?');
        $st->execute( array( $expire ) );
    }
    
    public function initialize(){
        $db = $this->db();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $file = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'schema' . DIRECTORY_SEPARATOR . 'session.sql';
        $queries = explode(";\n", file_get_contents($file));
        foreach( $queries as $sql ) $db->query( $sql );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/
   
    protected function loadBySessionID(){
        if( ! isset( $this->session_id )) return;
        if( isset( $this->token ) ) return;
        $db = $this->db();
        $st = $db->prepare('SELECT * FROM session WHERE session_id = ?');
        $st->execute( array($this->session_id ) );
        $this->loadData($st->fetch(PDO::FETCH_ASSOC));
        $st->closeCursor();
    }
    
    protected function loadByToken(){
        if( ! isset( $this->token )) return;
        if( isset( $this->session_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM session WHERE token = ?");
        $st->execute( array( $this->token ) );
        $this->loadData($st->fetch(PDO::FETCH_ASSOC));
        $st->closeCursor();
    }
    
    protected function loadData( $data ){
        if( ! is_array( $data ) || 
            ! isset( $data['modified'] ) || 
            $data['modified'] + 3600 < $this->now() ) {
            unset( $this->session_id );
            return;
        }
        $extra = $this->decode($data['data']);
        unset( $data['data']);
        foreach( $data as $k=>$v) $this->$k = $v;
        foreach( $extra as $k=>$v) $this->$k = $v;
    }
    
    protected function now(){
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
    
    protected function checksum(){
        return md5(strval($this));
    }
    
    protected function db(){
        if( isset( self::$db ) ) return self::$db;
        $path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . self::filename;
        $db = new PDO('sqlite2:' . $path, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
}

// EOF 