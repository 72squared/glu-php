<?php
$this->baseurl = rtrim( substr( dirname($this->server->SCRIPT_FILENAME) . '/', 
                 strlen($this->server->DOCUMENT_ROOT)), ' /');