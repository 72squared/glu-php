<?php

$available_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'available' . DIRECTORY_SEPARATOR;
$enabled_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'enabled' . DIRECTORY_SEPARATOR;

$modules = 
array(
    'baseurl_modrewrite',
    'load_session',
    'load_permission',
);

foreach( glob( $enabled_dir . '*.php') as $file ) {
    unlink( $file );
}
foreach( $modules as $i=>$module ){
    $module .= '.php';
    $target = $available_dir . $module;
    $destination = $enabled_dir . str_pad( $i, 3, '0', STR_PAD_LEFT) . '0_' . $module;
    if( ! file_exists( $target ) ) continue;
    symlink( '../available/' . $module,  $destination);
}