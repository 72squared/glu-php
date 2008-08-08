<?php
$d = $this->instance();
$d->baseurl = $this->baseurl;
$d->path = $this->path;
$session = $d->session = $this->Session();
$user = $d->user = $this->User;
$session = $d->session;
unset( $session->user_id);
$nonce = $this->Nonce( 'login' . $session->token . $session->session_id );

if( $this->login ){
    if( ! $nonce->validate( $this->nonce) ) throw new Exception('invalid-nonce');
    $user = $this->User( $this->login );
    if( $user->passhash != $user->secretHash( $this->password ) ) throw new Exception('invalid-login');
    $d->user = $user;
    $session->user_id = $user->user_id;
    $session->store();
} 
$noncekey = $nonce->create();
$d->title = 'Login';
$d->action = $this->baseurl . $this->path;
$d->nonce = $noncekey;
return $d;

//EOF