#!/usr/bin/env php
<?php
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';

TapTest::plan(14);

ob_start();
$response = GLU::instance()->dispatch(dirname(dirname(__FILE__)) . '/app/run.php');
$output = ob_get_clean();

TapTest::is( trim($output), '>', 'output is a prompt');
TapTest::is( $response, TRUE, 'response is true');

ob_start();
$response = GLU::instance(array('line'=>'hello'))->dispatch(dirname(dirname(__FILE__)) . '/app/run.php');
$output = ob_get_clean();

TapTest::like( $output, '/\>/', 'output has a prompt');
TapTest::like( $output, '/hello/i', 'output says hello');
TapTest::is( $response, TRUE, 'response is true');


ob_start();
$response = GLU::instance(array('line'=>'help'))->dispatch(dirname(dirname(__FILE__)) . '/app/run.php');
$output = ob_get_clean();


TapTest::like( $output, '/\>/', 'output has a prompt');
TapTest::like( $output, '/help/i', 'output says help');
TapTest::like( $output, '/type a command/i', 'output gives instructions');
TapTest::is( $response, TRUE, 'response is true');

ob_start();
$response = GLU::instance(array('line'=>'now'))->dispatch(dirname(dirname(__FILE__)) . '/app/run.php');
$output = ob_get_clean();

TapTest::like( $output, '/\>/', 'output has a prompt');
TapTest::like( $output, '/the time is/i', 'output says the time is');
TapTest::is( $response, TRUE, 'response is true');

ob_start();
$response = GLU::instance(array('line'=>'quit'))->dispatch(dirname(dirname(__FILE__)) . '/app/run.php');
$output = ob_get_clean();

TapTest::like( $output, '/good bye/i', 'output says good bye');
TapTest::is( $response, FALSE, 'response is false');
