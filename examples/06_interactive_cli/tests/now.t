#!/usr/bin/env php
<?php
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';
TapTest::plan(4);

ob_start();
GLU::instance()->dispatch(dirname(dirname(__FILE__)) . '/app/action/now.php');
$output = ob_get_clean();

TapTest::like( $output, '/The time is/i', 'output says time is ...');
TapTest::like( $output, '/GMT/i', 'output says GMT');

ob_start();
GLU::instance(array('now'=>'1213286964', 'timezone'=>'GMT', 'format'=>'Y/m/d H:i:s e'))->dispatch(dirname(dirname(__FILE__)) . '/app/action/now.php');
$output = ob_get_clean();

TapTest::like( $output, '#2008/06/12 16:09:24 GMT#i', 'output prints correct GMT formatted time');


ob_start();
GLU::instance(array('now'=>'1213286963', 'timezone'=>'UTC', 'format'=>'Y/m/d H:i:s e'))->dispatch(dirname(dirname(__FILE__)) . '/app/action/now.php');
$output = ob_get_clean();

TapTest::like( $output, '#2008/06/12 16:09:23 UTC#i', 'output prints correct UTC formatted time');

