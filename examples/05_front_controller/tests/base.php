<?php
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . '__autoload.php';

$vars = array('route'=>$route, 'start'=>$start = microtime(TRUE), 'request'=>$input);
ob_start();
GLU::instance( $vars )->dispatch(dirname(dirname(__FILE__)) . '/app/main.php');
$output = trim(ob_get_clean());
$dom = new DOMDocument();
$dom->loadHTML( $output );


// EOF