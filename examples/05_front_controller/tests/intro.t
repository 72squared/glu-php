#!/usr/bin/env php
<?php
chdir( dirname(__FILE__)  );
$route = 'intro';
include 'base.php';

TapTest::plan(11);
TapTest::like($output, '/<html>/', 'output is html' );
TapTest::like($dom->getElementsByTagName('title')->item(0)->nodeValue, '/Introduction/i', 'title says intro');
TapTest::like($dom->getElementsByTagName('title')->item(0)->nodeValue, '/glu app/i', 'title says glu app' );
TapTest::like($dom->getElementsByTagName('h1')->item(0)->nodeValue, '/front-end/i', 'h1 tag says front end');
TapTest::like($dom->getElementsByTagName('h2')->item(0)->nodeValue, '/Welcome to GLU/i', 'h2 tag says welcome');
TapTest::like( $output, '/This illustrates the basics/i', 'output says demo message');
TapTest::like( $output, '/page generated in ([+-]?\\d*\\.\\d+)(?![-+0-9\\.]) seconds/i', 'page generated time in message' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/index\">Home<\\/a>#", 'nav link points home' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/helloworld\">Hello World<\\/a>#", 'nav link points to hello world' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/intro\">Introduction<\\/a>#", 'nav link points to intro' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/ajaxdemo\">Ajax Demo<\\/a>#", 'nav link points to ajax demo' );        
