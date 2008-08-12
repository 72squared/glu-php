<?php
define('SCRIPT_START_TIME', microtime(TRUE));
define('ROOT_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR );
include ROOT_DIR . 'class' . DIRECTORY_SEPARATOR . '__autoload.php';

ob_start();
$grok = new Grok;
$grok->dispatch(ROOT_DIR . 'util/load');

try {
    $grok->dispatch(ROOT_DIR . 'route/' . $grok->route );
    foreach( $grok->keys() as $k ) unset( $grok->$k );
} catch( Exception $e ){
    $grok->exception = $e;
    $grok->debug = ob_get_clean();
    ob_start();
    $grok->dispatch(ROOT_DIR . 'route/error');
}
unset( $grok );
ob_end_flush();

//EOF