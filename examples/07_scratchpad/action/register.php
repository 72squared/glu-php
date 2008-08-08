<?php
$d = $this->instance();
$d->baseurl = $this->baseurl;
$d->path = $this->path;
$session = $d->session = $this->Session();
$user = $d->user = $this->User( $session->user_id );
if( $this->nickname ){
    $user->nickname = $this->nickname;
    $user->email = $this->email;
    $user->nickname = $this->nickname;
    $user->passhash = $user->secretHash( $this->password );
    $session->user_id = $user->user_id;
    $user->store();
}
$title = 'Register';

$d->action = $this->baseurl . $this->path;
$d->title = $title;
return $d;



//EOF