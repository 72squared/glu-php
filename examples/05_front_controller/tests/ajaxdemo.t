#!/usr/bin/env php
<?php
chdir( dirname(__FILE__)  );
$route = 'ajaxdemo';
include 'base.php';

TapTest::plan(15);
TapTest::like($output, '/<html>/', 'output is html' );
TapTest::like($dom->getElementsByTagName('title')->item(0)->nodeValue, '/Ajax Demo/i', 'title says ajax demo');
TapTest::like($dom->getElementsByTagName('title')->item(0)->nodeValue, '/glu app/i', 'title says glu app' );
TapTest::like($dom->getElementsByTagName('h1')->item(0)->nodeValue, '/front-end/i', 'h1 tag says front end');
TapTest::like($dom->getElementsByTagName('h2')->item(0)->nodeValue, '/Ajax Demo/i', 'h2 tag says ajax demo');
TapTest::like( $output, '/this text will be replaced/i', 'output says this text will be replaced');
TapTest::like( $output, '/page generated in ([+-]?\\d*\\.\\d+)(?![-+0-9\\.]) seconds/i', 'page generated time in message' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/index\">Home<\\/a>#", 'nav link points home' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/helloworld\">Hello World<\\/a>#", 'nav link points to hello world' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/intro\">Introduction<\\/a>#", 'nav link points to intro' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/ajaxdemo\">Ajax Demo<\\/a>#", 'nav link points to ajax demo' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/ajaxdemo\?response=1&amp;dummy=data(.+)\">run test<\\/a>#", 'link to run test' );
TapTest::like( $output, "#yahoo-min.js#", 'YUI main script present' );
TapTest::like( $output, "#event-min.js#", 'YUI event script present' );
TapTest::like( $output, "#ajaxdemo\?script=1#", 'script ajax demo present' );

