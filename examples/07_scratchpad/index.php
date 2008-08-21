<?php
$start = microtime(TRUE);
$sep = DIRECTORY_SEPARATOR;
$dir = dirname(__FILE__) . $sep;
include $dir . 'class' . $sep . '__autoload.php';
$app = new App_Namespace(array('START_TIME'=>$start));
$app->NEW = new Instantiator;
try {
    $pattern = $dir . 'modules' . $sep . 'enabled' .$sep . '*.php';
    $files = glob($pattern);
    if( ! is_array( $files ) ) throw $app->NEW->Exception('invalid-config');
    if( count( $files ) < 1 ) {
        $app->dispatch( $dir . 'modules' . $sep . 'initialize');
        $files = glob($pattern);
        if( ! is_array( $files ) || count( $files ) < 1 ) {
            throw $app->NEW->Exception('fail-initialize-modules');
        }
    }
    foreach( $files as $file ) {
       if( $app->dispatch( $file ) === FALSE ) break;
    }
    
} catch( Exception $e ){
    print $e;
}
//EOF