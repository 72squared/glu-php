#!/usr/bin/env php
<?php
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';

TapTest::plan(2);

ob_start();
$response = GLU::instance()->dispatch(dirname(dirname(__FILE__)) . '/app/action/quit.php');
$output = ob_get_clean();

TapTest::like( $output, '/good bye/i', 'output says good bye');
TapTest::ok( ! $response, 'response from dispatch is FALSE');
