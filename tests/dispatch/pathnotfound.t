#!/usr/bin/env php
<?php
$strict = TRUE;
$path =  dirname(__FILE__) . '/lib/non_existent.php';
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(5);

TapTest::is( $result_dispatch, NULL, 'no return from dispatch');
TapTest::is( $result_export_before_dispatch, array(), 'export before dispatch is empty');
TapTest::is( $result_export_after_dispatch, NULL, 'never made it to after dispatch');
TapTest::isa( $exception, 'Exception', 'exception thrown' );
TapTest::like( $exception_message, '/dispatch/i', 'exception message from dispatch');
