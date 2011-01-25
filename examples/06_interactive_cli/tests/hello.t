#!/usr/bin/env php
<?php
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';

TapTest::plan(1);

ob_start();
GLU::instance()->dispatch(dirname(dirname(__FILE__)) . '/app/action/hello.php');
$output = ob_get_clean();

TapTest::like( $output, '/hello, world/i', 'output says hello, world');

