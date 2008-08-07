<?php
$request = $this->dispatch(ROOT_DIR . 'load/request');
$session = $this->dispatch(ROOT_DIR . 'load/session');
unset( $session->user_id );
if( $request->login ){
    $user = new User( $request->login );
    if( $user->passhash == md5( $request->password . 'salty') ) {
        $session->user_id = $user->user_id;
        return $this->dispatch(ROOT_DIR . 'action/display');
    }
}
$this->dispatch(ROOT_DIR . 'load/header')->title = 'Sign In';
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/login/form');
$this->dispatch(ROOT_DIR . 'layout/global/footer');
//EOF