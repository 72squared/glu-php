<?php
$this->digest = $this->server->PHP_AUTH_DIGEST;
$this->realm = 'Scratchpad Admin Area';
$this->htpasswd = $this->dir->ROOT . 'htpasswd/cleartext';

try {
    $this->dispatch($this->dir->ACTION . 'authdigest');
} catch( Exception $e ){
    $this->route = 'noauth';
    $this->exception = $e;
}


// EOF