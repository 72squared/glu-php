#!/usr/bin/env php
<?php
$arg = new stdclass;
$arg->a = 'test';
$arg->b = 'test';
$arg->c = 'test';
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(1);
TapTest::is( $result, array(), 'glu data exported is empty array when stdclass objects is passed in');
