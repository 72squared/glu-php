<?php

class User_Lister extends GLU {
    
    public function __set( $k, $v ){
        if( ! $v instanceof User ) return NULL;
        return parent::__set($k, $v);
    }
    
    public function __get($k ){
        $v = parent::__get( $k );
        if( $v instanceof User ) return $v;
        return $this->anonymous();
    }
    
    public function anonymous(){
        return new User(array('user_id'=>0, 'nickname'=>'Anonymous', 'email'=>''));
    }
}

// EOF