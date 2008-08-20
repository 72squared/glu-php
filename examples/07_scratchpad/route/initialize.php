<?php

$enabled_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'enabled' . DIRECTORY_SEPARATOR;
$touchfile = $enabled_dir . '.init';
if( file_exists( $touchfile ) ) return;
$available_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'available' . DIRECTORY_SEPARATOR;
foreach( glob( $enabled_dir . '*.php') as $file ) {
    unlink( $file );
}
foreach( glob($available_dir . '*.php') as $file ){
    $filename = substr($file, strrpos($file, DIRECTORY_SEPARATOR));
    $destination = $enabled_dir . $filename;
    symlink( '../available/' . $filename,  $destination);
}
touch( $touchfile );