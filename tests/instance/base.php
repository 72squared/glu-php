<?php
$DIR = realpath( dirname(__FILE__) . '/../../' ). DIRECTORY_SEPARATOR;
include_once $DIR . 'glu.php';
include_once $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';
$glu = GLU::instance($arg);
$result = array();
foreach( $glu as $k=>$v) $result[$k] = $v;
