<?php

class User_Lister extends Grok {
    
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