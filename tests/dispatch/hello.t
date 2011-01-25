#!/usr/bin/env php
<?php
$path = dirname(__FILE__) . '/lib/hello.php';
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(4);

TapTest::is( $result_dispatch, 'hi there', 'return from dispatch gives correct response');
TapTest::is( $result_export_before_dispatch, array(), 'export before dispatch is empty');
TapTest::is( $result_export_after_dispatch, array(), 'export after dispatch is empty');
TapTest::is( $exception, NULL, 'no exception thrown' );
