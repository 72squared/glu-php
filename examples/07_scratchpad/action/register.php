<?php
$this->session = $this->Session();
$this->user = $this->User( $this->session->user_id );
if( ! $this->request->nickname ) return;

$this->user->nickname = $this->request->nickname;
$this->user->email = $this->request->email;
$this->user->nickname = $this->request->nickname;
$this->user->passhash = $user->secretHash( $this->request->password );
$this->session->user_id = $user->user_id;
$this->user->store();

//EOF