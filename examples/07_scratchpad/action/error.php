<?php
$d = $this->instance();
$d->baseurl = $this->baseurl;
$d->path = $this->path;

try {
    $session = $d->session = $this->Session();
    $user = $d->user = $this->User( $session->user_id );
} catch( Exception $e ){

}
$title = 'an error occurred';
$body = $this->exception;


$d->title = 'Error';
$d->header = 'An error occurred';
$d->body = $body;
return $d;