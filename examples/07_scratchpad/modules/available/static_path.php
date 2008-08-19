<?php
$pos = strrpos($this->path, '.');
if($pos === FALSE ) return;
$ext = substr($this->path, strrpos($this->path, '.') + 1);
$extensions = array( 'gif', 'jpg', 'png', 'css','js', 'ico');
if( in_array( $ext, $extensions ) ) $this->route = 'static';

$file = $this->DIR_APP . 'static' . DIRECTORY_SEPARATOR . $this->path;
if( ! file_exists( $file ) ) return $this->dispatch($this->DIR_APP . 'run/pagenotfound');
$fp = @fopen($file, 'r');
if( ! $fp ) return $this->dispatch($this->DIR_APP . 'run/pagenotfound');
$ext = substr($this->path, strrpos($this->path, '.') + 1);
$extensions = 
array(  'gif'=> 'image/gif',
        'jpg'=> 'image/jpg',
        'png'=> 'image/png',
        'ico'=> 'image/x-icon',
        'css'=> 'text/plain',
        'js'=>  'text/plain',
);

header('Content-Type: ' .  (isset( $extensions[$ext] ) ? $extensions[$ext]  : 'text/plain'));
header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 1000000));
fpassthru($fp);
fclose($fp);
return FALSE;

//EOF