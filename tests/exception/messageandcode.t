#!/usr/bin/env php
<?php
$message = 'test message';
$code = '2';
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(3);

TapTest::is( $result->getMessage(), $message, 'exception message matches' );
TapTest::is( $result->getCode(), intval($code), 'exception code matches arg' );
TapTest::isa( $result, 'GLU_Exception', 'result is an exception');

