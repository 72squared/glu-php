#!/usr/bin/env php
<?php
$message = NULL;
$code = NULL;
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(3);

TapTest::is( $result->getMessage(), '', 'exception message says nothing' );
TapTest::is( $result->getCode(), 0, 'code defaults to zero' );
TapTest::isa( $result, 'GLU_Exception', 'result is an exception');
