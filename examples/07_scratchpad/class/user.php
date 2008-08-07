<?php

class User extends Persistent {
    
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
        $this->load();
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
    
    public function __destruct(){
        if( ! $this->nickname || ! $this->email ) return;
        return $this->checkAndStore();
    }
    
    protected function storage(){
        return new User_Storage();
    }
    
    protected function isUserId( $v ){
        $v = strval($v);
        if( ! preg_match("#^[0-9]+$#", $v ) ) return FALSE;
        if( $v < 0 ) return FALSE;
        return TRUE;
    }
    
    protected function isNickname($v){
        $v = strval($v);
        return preg_match('#^[a-z][a-z0-9_\-\ ]+$#i', $v);
    }
    
    protected function isEmail($v){
        $v = strval($v);
        return preg_match('#^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$#i', $v);
    }
    
    protected function isPassHash($v){
        $v = strval($v);
        return preg_match('#^[a-f0-9]{32}$#', $v);
    }
}

// EOF