<?php
$path = trim( $this->path, '/' );
if( strlen( $path ) < 1 ) return;
$pos = strrpos( $path, '.');
if( $pos === FALSE ) return;
$ext = substr( $path, $pos + 1);
$extensions = 
    array(  'gif'=> 'image/gif',
            'jpg'=> 'image/jpeg',
            'png'=> 'image/png',
            'ico'=> 'image/x-icon',
            'css'=> 'text/css',
            'js'=>  'text/js',
            'txt'=> 'text/plain',
            'ico'=> 'image/x-icon',
    );
    
if( ! isset( $extensions[ $ext ] ) ) return;
$path = $this->dir->ROOT . 'static/' . $path;
if( ! file_exists( $path ) ) return;
header('Cache-Control: max-age=604800');
header('Date: ' . date('D, j M Y G:i:s T'));
header('Expires: ' . date('D, j M Y G:i:s T', (time() + (24 * 3600)) ));
header('content-type: ' . $extensions[ $ext ]);
readfile( $path );
return TRUE;