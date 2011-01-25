<?php
try {
    $this->session = $this->NEW->Session();
    $this->user = $this->NEW->User( $this->session->user_id );
} catch( Exception $e ){
    $this->session = $this->NEW->GLU();
    $this->user = $this->NEW->GLU();
}
$this->user->role = guest;
if( $this->user->user_id ) $this->user->role = guest;
if( $this->user->user_id == 1 ) $this->user->role = admin;