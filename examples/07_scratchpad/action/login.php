<?php
$this->session = $this->Session();
$this->user = $this->User();
unset( $this->session->user_id);
$nonce = $this->Nonce( 'login' . $session->token . $session->session_id );

if( $this->request->login ){
    if( ! $nonce->validate( $this->request->nonce) ) throw new Exception('invalid-nonce');
    $user = $this->User( $this->request->login );
    if( $user->passhash != $user->secretHash( $this->request->password ) ) throw new Exception('invalid-login');
    $this->user = $user;
    $this->session->user_id = $user->user_id;
    $this->session->store();
} 
$this->nonce = $nonce->create();

//EOF