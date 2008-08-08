<?php

foreach( $_REQUEST as $k=>$v) $this->$k = filter_var($v);
$this->baseurl = rtrim( substr( dirname($_SERVER['SCRIPT_FILENAME']) . '/', 
                 strlen(realpath($_SERVER['DOCUMENT_ROOT']))), ' /');

$path = str_replace( $this->baseurl, '', $_SERVER['REQUEST_URI']);
if( ( $pos = strpos( $path, '?' ) ) !==FALSE) $path = substr( $path, 0, $pos );
$path = preg_replace( '/[^a-z0-9\/\_\-\.]/', '', $path );
$path = trim($path, ' /');
$this->path = '/' . $path;

if( substr($this->path,-5) == '.text' ) {
    $this->path = substr($this->path, 0, -5);
    $this->route = 'text';
} elseif(preg_match('#^/[0-9]+$#', $this->path)){
    $this->path = substr($this->path, 1);
}
if( ! $this->route ) $this->route = 'display';