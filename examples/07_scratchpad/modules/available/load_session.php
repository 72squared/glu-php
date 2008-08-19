<?php
try {
    $this->session = $this->Session();
    $this->user = $this->User( $this->session->user_id );
} catch( Exception $e ){
    $this->session = $this->Grok();
    $this->user = $this->Grok();
}
$this->user->acl_guest = 1;
if( $this->user->user_id ) $this->user->acl_user = 1;
if( $this->user->user_id == 1 ) $this->user->acl_admin = 1;