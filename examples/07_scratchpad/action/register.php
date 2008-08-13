<?php
if( ! $this->user ) throw new Exception('invalid-user');
if( ! $this->session ) throw new Exception('invalid-session');
if( ! $this->request->nickname ) return;

$this->user->nickname = $this->request->nickname;
$this->user->email = $this->request->email;
$this->user->nickname = $this->request->nickname;
$this->user->passhash = $user->secretHash( $this->request->password );
$this->session->user_id = $user->user_id;
$this->user->store();

//EOF