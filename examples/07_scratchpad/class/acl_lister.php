<?php

class ACL_Lister extends Grok {
    
    public function __construct(){
        ACL::__list($this);
    }
    
    public function __set( $k, $v ){
        if( ! $v instanceof ACL ) return;
        return parent::__set($k, $v);
    }
}

// EOF