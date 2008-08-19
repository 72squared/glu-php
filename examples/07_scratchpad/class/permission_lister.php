<?php

class Permission_Lister extends Grok {
    
    public function __construct(){
        Permission::__list($this);
    }
    
    public function __set( $k, $v ){
        if( ! $v instanceof Permission ) return;
        return parent::__set($k, $v);
    }
}

// EOF