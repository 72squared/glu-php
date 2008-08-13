<?php
if( substr($this->path,-5) != '.text' ) return;
$this->path = substr($this->path, 0, -5);
$this->route = 'text';
