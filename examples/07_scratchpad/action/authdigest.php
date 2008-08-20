<?php
$digester = $this->NEW->httpauthdigest( array( 'htpasswd'=>$this->htpasswd, 'realm'=>$this->realm ) );
if( ! $digester->authenticate($this->digest, $this->request_method) ){
    $this->headers = $digester->challenge();
    throw $this->Exception('invalid-digest');
}
