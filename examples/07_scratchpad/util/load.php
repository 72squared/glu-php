<?php
$this->request = $this->instance();
foreach( $_REQUEST as $k=>$v) $this->request->$k = filter_var($v);
$this->baseurl = rtrim( substr( dirname($_SERVER['SCRIPT_FILENAME']) . '/', 
                 strlen(realpath($_SERVER['DOCUMENT_ROOT']))), ' /');

$path = str_replace( $this->baseurl, '', $_SERVER['REQUEST_URI']);
if( ( $pos = strpos( $path, '?' ) ) !==FALSE) $path = substr( $path, 0, $pos );
$path = preg_replace( '/[^a-z0-9\/\_\-\.]/', '', $path );
$path = trim($path, ' /');
$this->path = '/' . $path;

if( substr($this->path,-5) == '.text' ) {
    $this->path = substr($this->path, 0, -5);
    $this->request->route = 'text';
}
$this->route = (  $this->request->route ) ? $this->request->route :'display';


$pos = strrpos($this->path, '.');

if($pos === FALSE ) return;

$ext = substr($this->path, strrpos($this->path, '.') + 1);
$extensions = 
array(  'gif'=> 'image/gif',
        'jpg'=> 'image/jpg',
        'png'=> 'image/png',
        'css'=> 'text/plain',
        'js'=>  'text/plain',
);
if( isset( $extensions[$ext] ) ) $this->route = 'static';