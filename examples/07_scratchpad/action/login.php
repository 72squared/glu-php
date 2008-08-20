<?php
if( ! $this->user ) throw new Exception('invalid-user');
if( ! $this->session ) throw new Exception('invalid-session');
$session = $this->session;
$user = $this->user = $this->NEW->User();
unset( $session->user_id );
$nonce = $this->NEW->Nonce( 'login' . $session->token . $session->session_id );

if( $this->request->login ){
    if( ! $nonce->validate( $this->request->nonce) ) throw new Exception('invalid-nonce');
    $user = $this->NEW->User( $this->request->login );
    if( $user->passhash != $user->secretHash( $this->request->password ) ) throw new Exception('invalid-login');
    $this->user = $user;
    $this->session->user_id = $user->user_id;
    $this->session->store();
} 
$this->nonce = $nonce->create();

//EOF