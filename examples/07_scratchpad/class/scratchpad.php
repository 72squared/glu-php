<?php

class Scratchpad extends Persistent {
    
    public function __construct( $data = NULL ){
        if( $data === NULL ) return;
         if( is_scalar($data) ){
            if( preg_match("#^[0-9]+$#", $data ) ){
                $this->entry_id = $data;
            } else {
                $this->path = $data;
            }
        } else {
            parent::__construct($data);
        }
        $this->load();
    }
    
    public function history(){
        return $this->storage()->history( $this->dir_id );
    }
    
    public function children(){
        return $this->storage()->children( $this );
    }
    
    public function descendents(){
        return $this->storage()->descendents( $this );
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/
    
    protected function __set( $k, $v ){
        switch( $k ){
            case 'dir_id':          $v = intval($v);
                                    if( $v < 1 ) return NULL;
                                    break;
                                    
            case 'path':            $v = '/' . trim(strval($v), ' /-_');
                                    if( ! preg_match('#^[\/]?[a-z0-9\/\_\-]+$#i', $v) ) return NULL;
                                    break;
                                    
            case 'parent':          $v = intval($v);
                                    if( $v < 0 ) return NULL;
                                    break;
                                    
            case 'entry_id':        $v = intval($v);
                                    if( $v < 1 ) return NULL;
                                    break;
                                    
            case 'author':          $v = intval($v);
                                    if( $v < 1 ) return NULL;
                                    break;
                                    
            case 'created':         $v = strval($v);
                                    if( preg_match("/^[0-9]+$/", $v)) $v = date('Y/m/d H:i:s', $v);
                                    $v = strtotime( $v );
                                    if( ! $v ) return NULL;
                                    break;
                                    
            case 'body':            $v = strval($v);
                                    break;
            
            default : return NULL;
        }
        
        return parent::__set($k, $v);
    }
    
    public function storage(){
        return new Scratchpad_Storage();
    }
}

// EOF