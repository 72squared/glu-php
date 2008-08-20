<?php
$this->digest = $this->server->PHP_AUTH_DIGEST;
$this->realm = 'Scratchpad Admin Area';
$this->htpasswd = $this->DIR_APP . 'htpasswd/cleartext';

try {
    $this->dispatch($this->DIR_ROOT . 'action/authdigest');
} catch( Exception $e ){
    $this->route = 'noauth';
    $this->exception = $e;
}


// EOF