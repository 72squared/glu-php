#!/usr/bin/env php
<?php
$arg = array('0'=>'a', 'test'=>'test', '0a'=>'fun', '000'=>'fun', 'valid1'=>'1', 'a'=>'string', 'under_score'=>'test', 'dash-it'=>'test');
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(1);
TapTest::is( $result, $arg, 'glu data exported into new');
