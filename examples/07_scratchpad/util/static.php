<?php
$pos = strrpos($this->path, '.');
if($pos === FALSE ) return FALSE;
$ext = substr($this->path, strrpos($this->path, '.') + 1);
$extensions = 
array(  'gif'=> 'image/gif',
        'jpg'=> 'image/jpg',
        'png'=> 'image/png',
        'css'=> 'text/plain',
        'js'=>  'text/plain',
);
if( ! isset( $extensions[$ext] ) ) return FALSE;
$file = ROOT_DIR . 'route/static/' . DIRECTORY_SEPARATOR . $this->path;
if( ! file_exists( $file ) ) return $this->dispatch(ROOT_DIR . 'route/view/pagenotfound');
$fp = @fopen($file, 'r');
if( ! $fp ) return $this->dispatch(ROOT_DIR . 'route/view/pagenotfound');
header('Content-Type: ' .  $extensions[$ext]);
//header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 1000000));
fpassthru($fp);
fclose($fp);
return TRUE;

//EOF