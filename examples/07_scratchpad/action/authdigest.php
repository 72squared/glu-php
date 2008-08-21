<?php
$digester = $this->NEW->httpauthdigest( array( 'htpasswd'=>$this->htpasswd, 'realm'=>$this->realm ) );
if( ! $digester->authenticate($this->digest, $this->request_method) ){
    $this->headers = $this->NEW->Grok($digester->challenge());
    throw $this->NEW->Exception('invalid-digest');
}
