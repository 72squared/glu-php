<?php
if( substr($this->path,-5) != '.text' ) return;
$this->path = substr($this->path, 0, -5);
if( $this->path == '/index' ) $this->path = '/';
$this->route = 'text';
