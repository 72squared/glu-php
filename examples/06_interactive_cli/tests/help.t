#!/usr/bin/env php
<?php
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';

TapTest::plan(5);

ob_start();
GLU::instance()->dispatch(dirname(dirname(__FILE__)) . '/app/action/help.php');
$output = ob_get_clean();

TapTest::like( $output, '/type a command/i', 'output says type a command');
TapTest::like( $output, '/help/i', 'output says help');
TapTest::like( $output, '/hello/i', 'output says hello');
TapTest::like( $output, '/now/i', 'output says now');
TapTest::like( $output, '/quit/i', 'output says quit');
