<?php
try {
    $this->session = $this->Session();
    $this->user = $this->User( $this->session->user_id );
} catch( Exception $e ){
    $this->session = $this->Grok();
    $this->user = $this->Grok();
}
$this->user->role = guest;
if( $this->user->user_id ) $this->user->role = guest;
if( $this->user->user_id == 1 ) $this->user->role = admin;