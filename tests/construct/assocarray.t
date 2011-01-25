#!/usr/bin/env php
<?php
$arg = array('test'=>'string', 'stdclass'=> new stdclass);
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(4);

TapTest::is( $result_export_before_dispatch, $arg, 'export matches arg before dispatch');
TapTest::is( $result_export_after_dispatch, $arg, 'export matches arg after dispatch');
TapTest::is( $result_dispatch, 'hello', 'dispatch runs string, returns hello' );
TapTest::is( $exception, NULL, 'no exception thrown' );
