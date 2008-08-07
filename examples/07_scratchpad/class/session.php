<?php

class Session extends Persistent {
    
    
    public function __construct( $data = NULL ){
        if( $data === NULL ) return;
         if( preg_match("#^[0-9]+$#", $data ) ){
            $this->session_id = $data;
        } elseif( is_scalar( $data ) ){
            $this->token = $data;
        } else {
            parent::__construct($data);
        }
        $this->load();
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
        $now = $this->storage()->now();
        if( ($this->modified + 10 ) < $now ) $this->modified = $now;
        $this->checkAndStore();
    }
    
    protected function storage(){
        return new Session_Storage();
    }
}

// EOF 