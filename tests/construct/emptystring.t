#!/usr/bin/env php
<?php
$arg = '';
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(4);

TapTest::is( $result_export_before_dispatch, array(), 'export is empty before dispatch');
TapTest::is( $result_export_after_dispatch, array(), 'export is empty after dispatch');
TapTest::is( $result_dispatch, 'hello', 'dispatch runs string, returns hello' );
TapTest::is( $exception, NULL, 'no exception thrown' );
