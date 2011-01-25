#!/usr/bin/env php
<?php
$DIR = realpath( dirname(__FILE__) . '/../../../' ). DIRECTORY_SEPARATOR;
include $DIR . 'glu.php';
include $DIR . 'tests/' . DIRECTORY_SEPARATOR . 'taptest.php';

TapTest::plan(6);


$file_pointer = fopen(dirname(__FILE__) . '/stdin.mock.txt', 'r');
ob_start();
GLU::instance(array('STDIN'=>$file_pointer))->dispatch(dirname(dirname(__FILE__)) . '/app/main' );
$output = ob_get_clean();
fclose( $file_pointer );

TapTest::like( $output, '/hello/i', 'output says hello');
TapTest::like( $output, '/help/i', 'output says help');
TapTest::like( $output, '/good bye/i', 'output says goodbye');
TapTest::like( $output, '/error/i', 'output says error');
TapTest::like( $output, '/glu_exception/i', 'output says glu exception');
TapTest::ok( strpos( $output, '>') !== FALSE, 'output displays prompt');
