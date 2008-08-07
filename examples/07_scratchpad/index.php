<?php
define('SCRIPT_START_TIME', microtime(TRUE));
define('ROOT_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR );
include ROOT_DIR . 'class' . DIRECTORY_SEPARATOR . '__autoload.php';

ob_start();
$grok = new Grok;
$request = $grok->dispatch(ROOT_DIR . 'load/request');
try {
    if( ! $request->action ) $request->action = 'display';
    $grok->dispatch(ROOT_DIR . 'action/' . $request->action );
    foreach($grok->keys() as $k) unset( $grok->$k );
} catch( Exception $e ){
    $grok->exception = $e;
    $grok->debug = ob_get_clean();
    ob_start();
    return $grok->dispatch(ROOT_DIR . 'layout/global/error');
}
unset( $grok );

ob_end_flush();
