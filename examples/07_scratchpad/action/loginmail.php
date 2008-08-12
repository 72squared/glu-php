<?php
$this->session = $this->Session();
$this->user = $this->User();
unset( $this->session->user_id);
$nonce = $this->Nonce( 'login' . $session->token . $session->session_id );
$this->nonce = $nonce->create();

if( ! $this->request->email ) return;

if( ! $nonce->validate( $this->request->nonce) ) throw new Exception('invalid-nonce');
$authclass = ( $this->request->authtype == 'imap' ) ? 'Imap_Auth' : 'Pop3_Auth';
$auth = $this->$authclass(  $this->request->domain, $this->request->use_ssl );
$auth->authenticate( $this->request->email, $this->request->password );
$user = $this->User( $this->request->email );
$user->email = $this->request->email;
if( $this->request->nickname ) {
    $user->nickname = $this->request->nickname;
} else {
    if( ! $user->nickname ) $user->nickname = $this->request->email;
}
$user->passhash = $user->secretHash( $this->request->password );
$user->store();
$this->user = $user;
$this->session->user_id = $user->user_id;
$this->session->store();

//EOF