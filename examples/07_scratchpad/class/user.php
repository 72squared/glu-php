<?php

class User extends Grok {
    
    protected static $db;
    
    const filename = 'user.db';
    
    protected static $columns = array('user_id', 'nickname', 'email', 'passhash', 'created', 'modified');
    
    public function __construct( $data = NULL ){
        if( $data === NULL ) return;
        if( is_scalar( $data ) ){
            if( $this->isUserId( $data ) ){
                $this->user_id = $data;
            } elseif( $this->isEmail( $data ) ){
                $this->email = $data;
            } elseif( $this->isNickname( $data ) ){
                $this->nickname = $data;
            }
        } else {
            parent::__construct($data);
        }
        $this->loadByUserId();
        $this->loadByNickname();
        $this->loadByEmail();
    }
    
    public function secretHash( $word ){
        return md5( $word . $this->secret());
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/
    
    protected function __set( $k, $v ){
        $v = trim(substr(strval($v), 0, 500));
        switch( $k ){
            case 'user_id':         if( ! $this->isUserId( $v ) ) return NULL;
                                    $v = intval($v);
                                    break;
                                    
            case 'nickname':        if( ! $this->isNickname($v) ) return NULL;
                                    break;
                                    
            case 'email':           if( ! $this->isEmail($v) ) return NULL;
                                    break;
                                    
            case 'passhash':        if( ! $this->isPassHash($v) ) return NULL;
                                    break;
                                    
            case 'created':         if( preg_match("#^[0-9]+$#", $v)) $v = date('Y/m/d H:i:s', $v);
                                    $v = strtotime( $v );
                                    if( ! $v ) return NULL;
                                    
            case 'modified':        if( preg_match("#^[0-9]+$#", $v)) $v = date('Y/m/d H:i:s', $v);
                                    $v = strtotime( $v );
                                    if( ! $v ) return NULL;
                                    
            default:                if( ! preg_match('#[a-z][a-z0-9_]+$#', $k) ) return NULL;
                                    break;
        }
        
        return parent::__set($k, $v);
    }
    
    public function store(){
        if( ! $this->nickname ) throw new Exception('invalid-nickname');
        if( ! $this->passhash ) throw new Exception('invalid-passhash');
        if( ! $this->email ) throw new Exception('invalid-email');
        $this->modified = $this->now();
        if( ! $this->created ) $this->created = $this->now();
        $db = $this->db();
        $params = array();
        foreach(self::$columns as $k){
            $params[$k] = $this->$k;
        }
        if( $this->user_id ) {
            $st = $db->prepare("INSERT OR REPLACE INTO user (user_id, nickname, passhash, email, created, modified) VALUES (:user_id, :nickname, :passhash, :email, :created, :modified)");
            $st->execute($params);
        } else {
            unset( $params['user_id'] );
            $st = $db->prepare("INSERT INTO user (nickname, passhash, email, created, modified) VALUES (:nickname, :passhash, :email, :created, :modified)");
            $st->execute( $params );
            $this->user_id = $db->lastInsertId();
        }
        
        if( ! $this->user_id ) throw Exception('invalid-user_id');
        try {
            $db->beginTransaction();
            $st = $db->prepare("DELETE FROM user_attribute WHERE user_id = ?");
            $st->execute(array($this->user_id ));
            $st = $db->prepare("INSERT INTO user_attribute (user_id, label, data) VALUES (:user_id, :label, :data)");
            foreach( $this as $k => $v ){
                if( in_array($k, self::$columns) ) continue;
                $st->execute(array('user_id'=>$this->user_id, 'label'=>$k, 'data'=>$v) );
            }
            $db->commit();
        } catch( Exception $e ){
            $db->rollback();
            throw $e;
        }
    }
    
    public static function fetch($ids){
        $iterator = new User_Lister;
        if( ! is_array($ids) || count($ids) < 1 ) return $iterator;
        $clean_ids = array();
        foreach($ids as $id ) {
            $id = intval($id );
            if( $id < 1 ) continue;
            $clean_ids[] = $id;
        }
        if(( $ct = count($clean_ids ) ) < 1 ) return $iterator;
        $db = self::db();
        $st = $db->prepare(sprintf("SELECT * FROM user WHERE user_id IN( %s )",  implode(', ', array_fill(0, $ct, '?'))) );
        $st->execute($clean_ids);
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $k = $row['user_id'];
            $iterator->$k = new self( $row );
        }
        $st->closeCursor();
        return $iterator;
    }
    
    public static function listing($start = 0, $offset = 20){
        $db = self::db();
        $st = $db->query(sprintf("SELECT * FROM user LIMIT %d, %d", $start, $offset));
        $iterator = new User_Lister;
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $k = $row['user_id'];
            $iterator->$k = new self( $row );
        }
        $st->closeCursor();
        return $iterator;
    }
    
    public static function listingCount(){
        $db = self::db();
        $st = $db->prepare("SELECT count(user_id) as ct FROM user");
        $st->execute(array($start, $offset ));
        $ids = array();
        $ct = ( $row = $st->fetch(PDO::FETCH_ASSOC) ) ? $row['ct'] : 0;
        $st->closeCursor();
        return $ct;
    }
    
    public static function search($name){
        $db = self::db();
        $st = $db->prepare("SELECT * FROM user WHERE nickname LIKE ?");
        $st->execute(array($name ));
        $iterator = new User_Lister;
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $k = $row['user_id'];
            $iterator->$k = new self( $row );
        }
        $st->closeCursor();
        return $iterator;
    }
    
    
    public function initialize(){
        $db = $this->db();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $file = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'schema' . DIRECTORY_SEPARATOR . 'user.sql';
        $queries = explode(";\n", file_get_contents($file));
        foreach( $queries as $sql ) $db->query( $sql );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/
    
    public function loadAttributes(){
        if( ! $this->user_id ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT label, data FROM user_attribute WHERE user_id = ?");
        $st->execute( array($this->user_id) );
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $k = $row['label'];
            $v = $row['data'];
            $this->$k = $v;
        }
        $st->closeCursor();
    }
    
    protected function loadByUserId(){
        if( ! isset( $this->user_id )) return;
        if( isset( $this->nickname ) ) return;
        $db = $this->db();
        $st = $db->prepare('SELECT * FROM user WHERE user_id = ?');
        $st->execute( array($this->user_id ) );
        $data = $st->fetch(PDO::FETCH_ASSOC);
        $st->closeCursor();
        if( ! $data ) {
            unset( $this->user_id );
            return;
        }
        foreach( $data as $k=>$v) $this->$k = $v;
        $this->loadAttributes();
    }
    
    protected function loadByNickname(){
        if( ! isset( $this->nickname )) return;
        if( isset( $this->user_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM user WHERE nickname = ?");
        $st->execute( array( $this->nickname ) );
        $data = $st->fetch(PDO::FETCH_ASSOC);
        $st->closeCursor();
        if( ! $data ){
            unset( $this->nickname );
            return;
        }
        foreach( $data as $k=>$v) $this->$k = $v;
        $this->loadAttributes();
    }
    
    protected function loadByEmail(){
        if( ! isset( $this->email )) return;
        if( isset( $this->user_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM user WHERE email = ?");
        $st->execute( array( $this->email ) );
        $data = $st->fetch(PDO::FETCH_ASSOC);
        $st->closeCursor();
        if( ! $data ){
            unset( $this->email );
            return;
        }
        foreach( $data as $k=>$v) $this->$k = $v;
        $this->loadAttributes();
    }
    
    protected function now(){
        return time();
    }
        protected function isUserId( $v ){
        $v = strval($v);
        if( ! preg_match("#^[0-9]+$#", $v ) ) return FALSE;
        if( $v < 0 ) return FALSE;
        return TRUE;
    }
    
    protected function isNickname($v){
        $v = strval($v);
        return preg_match('#^[a-z][a-z0-9_\-\ ,]+$#i', $v);
    }
    
    protected function isEmail($v){
        $v = strval($v);
        return preg_match('#^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$#i', $v);
    }
    
    protected function isPassHash($v){
        $v = strval($v);
        return preg_match('#^[a-f0-9]{32}$#', $v);
    }
    
    protected function secret(){
        return 'salty';
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