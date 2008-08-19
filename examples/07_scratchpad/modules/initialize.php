<?php

$available_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'available' . DIRECTORY_SEPARATOR;
$enabled_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'enabled' . DIRECTORY_SEPARATOR;

$modules = 
array(
    'load_request',
    'load_server',
    'acl_actions',
    'baseurl_modrewrite',
    'extract_path',
    'route_by_request',
    'route_text_path',
    'load_default_dir_paths',
    'static_path',
    'load_session',
    'run',
    'print_headers',
    'unset_data',
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