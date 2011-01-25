#!/usr/bin/env php
<?php
// include the glu
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';
TapTest::plan(2);

ob_start();
GLU::instance()->dispatch(dirname(dirname(__FILE__)) . '/lib/main.php');
$output = ob_get_clean();

TapTest::like( $output, '/hello/i', 'says hello');
TapTest::like( $output, '/from glu/i', 'from glu class');
