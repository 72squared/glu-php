#!/usr/bin/env php
<?php
$arg = new ArrayIterator($inner = array('a', 'b', 'c'));
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(1);
TapTest::is( $result, $inner, 'glu data exported into new from iterator');
