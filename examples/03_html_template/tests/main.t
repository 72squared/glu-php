#!/usr/bin/env php
<?php
// include the glu
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';
TapTest::plan(5);

ob_start();
GLU::instance()->dispatch(dirname(dirname(__FILE__)) . '/lib/main.php');
$output = trim( ob_get_contents() );
ob_end_clean();

TapTest::is( substr( $output, 0, 6), '<html>', 'output starts with opening html tag');
TapTest::is( substr( $output, -7), '</html>', 'output ends with closing html tag');
TapTest::like($output, '#<title>TPL</title>#i', 'output has tpl title');
TapTest::like($output, '#<h1>template example</h1>#i', 'output has correct h1 tag');
TapTest::like($output, '#<p>shows how to build a templating system</p>#i', 'output has correct content inside p tag');


// EOF