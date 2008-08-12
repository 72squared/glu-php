<?php

class Scratchpad_Lister extends Grok {
    
    public function __construct( $ids = NULL ){
        $this->Scratchpad()->batch( $this, $ids );
    }
    
    protected function __set( $k, $v ){
        if( ! $v instanceof Scratchpad ) return NULL;
        return parent::__set($k, $v);
    }
}

// EOF