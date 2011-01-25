#!/usr/bin/env php
<?php
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';

TapTest::plan(1);

ob_start();
GLU::instance()->dispatch(dirname(dirname(__FILE__)) . '/app/prompt.php');
$output = ob_get_clean();

TapTest::like( $output, '/>/', 'output says >');
