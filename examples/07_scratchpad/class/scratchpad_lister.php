<?php

class Scratchpad_Lister extends Grok {
    
    public function __construct( $ids = NULL ){
        $this->storage()->batch( $this, $ids );
    }
    
    protected function __set( $k, $v ){
        if( ! $v instanceof Scratchpad ) return NULL;
        return parent::__set($k, $v);
    }
    
    public function storage(){
        return new Scratchpad_Storage();
    }
}

// EOF