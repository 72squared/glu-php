#!/usr/bin/env php
<?php
$arg = dirname(__FILE__);
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(4);

TapTest::is( $result_export_before_dispatch, array(), 'export is empty before dispatch');
TapTest::is( $result_export_after_dispatch, array(), 'export is empty after dispatch');
TapTest::is( $result_dispatch, 'hello', 'dispatch runs the string file, get hello back' );
TapTest::is( $exception, NULL, 'exception is null' );
