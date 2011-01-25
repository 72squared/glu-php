#!/usr/bin/env php
<?php
// include the glu
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';
TapTest::plan(2);

class test_glu extends glu { }

$o = new test_glu(array('greeting'=>'welcome'));
$output = $o->dispatch(dirname(dirname(__FILE__)) . '/lib/hello.php' );

TapTest::like($output, '/welcome/i', 'says welcome');
TapTest::like($output, '/from test_glu/i', 'from test_glu class');


// EOF
