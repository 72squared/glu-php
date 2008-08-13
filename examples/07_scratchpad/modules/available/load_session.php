<?php
try {
    $this->session = $this->Session();
    $this->user = $this->User( $this->session->user_id );
} catch( Exception $e ){
    $this->session = $this->Grok();
    $this->user = $this->Grok();
}