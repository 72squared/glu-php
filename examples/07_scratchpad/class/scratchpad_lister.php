<?php

class Scratchpad_Lister extends GLU {
    
    public function __set( $k, $v ){
        if( ! $v instanceof Scratchpad ) return NULL;
        return parent::__set($k, $v);
    }
}

// EOF