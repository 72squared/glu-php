<?php

class Config extends Persistent {
    
    public function __construct( $data = NULL ){
        $this->load();
        parent::__construct($data);
    }
    
    public static function instance( $data = NULL){
        static $instance;
        if( isset( $instance ) ) return $instance;
        return $instance = new self( $data );
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/
    
    protected function __set( $k, $v ){
        return parent::__set($k, substr(strval($v), 0, 500));
    }
    
    protected function storage(){
        return new Config_Storage;
    }
}

// EOF 