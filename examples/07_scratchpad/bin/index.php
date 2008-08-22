<?php
$start = microtime(TRUE);
$sep = DIRECTORY_SEPARATOR;
$dir = dirname(dirname(__FILE__)) . $sep;
include $dir . 'class' . $sep . '__autoload.php';
$app = new App_Namespace(array('START_TIME'=>$start));
ob_start();
try {
    $pattern = $dir . 'modules' . $sep . 'enabled' .$sep . '*.php';
    $files = glob($pattern);
    if( ! is_array( $files ) ) throw $app->NEW->Exception('invalid-config');
    foreach( $files as $file ) {
       if( $app->dispatch( $file ) === FALSE ) break;
    }
    ob_start();

    $app->dispatch( $app->dir->ROOT . 'route/initialize');
    
    try {
        $app->dispatch( $app->dir->ROOT . 'route/enabled/' . $app->route );
    } catch( Exception $e ){
        $app->exception = $e;
        $app->debug = ob_get_clean();
        ob_start();
        $app->dispatch($app->dir->ROOT . 'route/available/error');
    }
    
    if( $app->headers ){
        foreach( $app->headers as $k=>$v ) {
            if( is_numeric( $k ) ) {
                header($v);
            } else {
                header($k . ': ' . $v);
            }
        }
        unset( $app->headers );
    }
    
    foreach( $app->keys() as $k ) unset( $app->$k );
    
    ob_end_flush();
    
} catch( Exception $e ){
    print $e;
}
ob_end_flush();
//EOF