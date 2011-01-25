<?php
$DIR = realpath( dirname(__FILE__) . '/../../' ). DIRECTORY_SEPARATOR;
include_once $DIR . 'glu.php';
include_once $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';

$glu = $message = $code = $result = NULL;
$glu = GLU::instance();
 if( $message === NULL ){
    $result = GLU::instance()->exception();
} elseif( $code === NULL ){
    $result = GLU::instance()->exception( $message );
} else {
    $result = GLU::instance()->exception( $message, $code );
}
