#!/usr/bin/env php
<?php
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';

TapTest::plan(2);

ob_start();
GLU::instance(array('exception'=>'exception_string'))->dispatch(dirname(dirname(__FILE__)) . '/app/error.php');
$output = ob_get_clean();

TapTest::like( $output, '/error/i', 'output says error');
TapTest::like( $output, '/exception_string/i', 'output says exception_string');
