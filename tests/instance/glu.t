#!/usr/bin/env php
<?php
$DIR = realpath( dirname(__FILE__) . '/../../' ). DIRECTORY_SEPARATOR;
include_once $DIR . 'glu.php';

$arg =  GLU::instance();
$arg->test = 'test string';
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(2);

$export = array();
foreach( $arg as $k=>$v) $export[$k] = $v;
TapTest::is( $result, $export, 'export returns arg');
TapTest::is( $result['test'], $arg->test, 'glu data exported into new');



// EOF