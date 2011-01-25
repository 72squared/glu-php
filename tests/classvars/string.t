#!/usr/bin/env php
<?php
$input = array('a'=>'string1', 'coMpLexKey'=>'b', 'fun'=>'run', '__data'=>'test', 'bad-key'=>'test' );
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';
TapTest::plan(5);
TapTest::is( $input, $result_set, 'set works properly' );
TapTest::is( $input, $result_get, 'get works properly' );
TapTest::is( array_fill_keys( array_keys( $input ), TRUE), $result_isset, 'isset works properly' );
TapTest::is( array_fill_keys( array_keys( $input ), NULL), $result_unset, 'unset works properly' );
TapTest::is( $glu->non_existent, NULL, 'non-existent variables are null' );
