<?php
$this->baseurl = rtrim( substr( $this->server->SCRIPT_FILENAME, 
                 strlen($this->server->DOCUMENT_ROOT)), ' /');

if( strpos($this->server->REQUEST_URI,  $this->baseurl) === FALSE ) $this->path = '/';