<?php

class User_Lister extends Grok {
    
    public function __construct( $ids = NULL ){
        $this->User()->batch( $this, $ids );
    }
    
    protected function __set( $k, $v ){
        if( ! $v instanceof User ) return NULL;
        return parent::__set($k, $v);
    }
    
    protected function __get($k ){
        $v = parent::__get( $k );
        if( $v instanceof User ) return $v;
        return $this->anonymous();
    }
    
    public function anonymous(){
        return $this->User(array('user_id'=>0, 'nickname'=>'Anonymous', 'email'=>''));
    }
}

// EOF