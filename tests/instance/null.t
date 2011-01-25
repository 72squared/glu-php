#!/usr/bin/env php
<?php
$arg = NULL;
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(1);
TapTest::is( $result, array(), 'glu data exported is empty array when null is passed in');
