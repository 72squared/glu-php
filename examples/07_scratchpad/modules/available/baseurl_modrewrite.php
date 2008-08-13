<?php
$this->baseurl = rtrim( substr( dirname($this->server->SCRIPT_FILENAME) . '/', 
                 strlen(realpath($this->server->DOCUMENT_ROOT))), ' /');
