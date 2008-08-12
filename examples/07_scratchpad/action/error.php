<?php
try {
    $this->session = $this->Session();
    $this->user = $this->User( $this->session->user_id );
} catch( Exception $e ){

}
$title = 'an error occurred';
$body = $this->exception;


$this->title = 'Error';
$this->header = 'An error occurred';
$this->body = $body;