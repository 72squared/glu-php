#!/usr/bin/env php
<?php
$message = 'test message';
$code = NULL;
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(3);

TapTest::is( $result->getMessage(), $message, 'exception message matches arg' );
TapTest::is( $result->getCode(), 0, 'code defaults to zero' );
TapTest::isa( $result, 'GLU_Exception', 'result is an exception');
