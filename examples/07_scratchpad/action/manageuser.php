<?php

$this->manageuser = $user = $this->User($this->request->id);

if( ! is_array( $this->request->attr ) ) return;

foreach($this->request->attr as $k=>$v){
    if( $k == '__') continue;
    if( strlen($v) < 1 ) {
        unset( $user->$k );
    } else {
        $user->$k = $v;
    }
}
if( strlen( $this->request->__k ) > 0 && strlen( $this->request->__v ) > 0 ){
    $user->{ $this->request->__k } = $this->request->__v;
}
$user->store();