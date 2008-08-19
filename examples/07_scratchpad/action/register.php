<?php
if( ! $this->user ) throw new Exception('invalid-user');
if( ! $this->session ) throw new Exception('invalid-session');
if( ! $this->request->nickname ) return;
$user = $this->user;

$user->nickname = $this->request->nickname;
$user->email = $this->request->email;
$user->nickname = $this->request->nickname;
$user->passhash = $user->secretHash( $this->request->password );
$this->session->user_id = $user->user_id;
$user->store();

//EOF