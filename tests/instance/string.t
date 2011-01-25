#!/usr/bin/env php
<?php
$arg = 'test string';
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(1);
TapTest::is( $result, array(), 'string passed in does nothing');
