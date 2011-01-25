#!/usr/bin/env php
<?php
// include the glu
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';
TapTest::plan(2);

ob_start();
GLU::instance()->dispatch(dirname(dirname(__FILE__)) . '/lib/main.php');
$output = ob_get_contents();
ob_end_clean();

TapTest::like($output, '/hello/i', 'says hello');
$path = str_replace('/', '\\' . DIRECTORY_SEPARATOR, 'level1/level2/level3/level5/hello.php');
TapTest::like( $output, '/' . $path . '/i', 'reached correct nesting');  


// EOF