<?php
$request = $this->dispatch(ROOT_DIR . 'load/request');

if( $request->nickname ){
    $user = $this->dispatch(ROOT_DIR . 'load/user');
    $user->nickname = $request->nickname;
    $user->email = $request->email;
    $user->nickname = $request->nickname;
    $user->passhash = md5( $request->password . 'salty');
    $this->dispatch(ROOT_DIR . 'load/session')->user_id = $user->user_id;
    $user->store();
    return $this->dispatch(ROOT_DIR . 'action/display');
}
$this->dispatch(ROOT_DIR . 'load/header')->title = 'Register';
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/register/form');
$this->dispatch(ROOT_DIR . 'layout/global/footer');
//EOF