#!/usr/bin/env php
<?php
chdir( dirname(__FILE__)  );
$route = 'helloworld';
$input = array('name'=>'stranger');
include 'base.php';

TapTest::plan(12);
TapTest::like($output, '/<html>/', 'output is html' );
TapTest::like($dom->getElementsByTagName('title')->item(0)->nodeValue, '/Hello, World/i', 'title says hello');
TapTest::like($dom->getElementsByTagName('title')->item(0)->nodeValue, '/glu app/i', 'title says glu app' );
TapTest::like($dom->getElementsByTagName('h1')->item(0)->nodeValue, '/front-end/i', 'h1 tag says front end');
TapTest::like($dom->getElementsByTagName('h2')->item(0)->nodeValue, '/Hello, World!/i', 'h2 tag says Hello');
TapTest::like( $output, '/Howdy, stranger/i', 'output says howdy');
TapTest::like( $output, '/page generated in ([+-]?\\d*\\.\\d+)(?![-+0-9\\.]) seconds/i', 'page generated time in message' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/index\">Home<\\/a>#", 'nav link points home' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/helloworld\">Hello World<\\/a>#", 'nav link points to hello world' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/intro\">Introduction<\\/a>#", 'nav link points to intro' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/ajaxdemo\">Ajax Demo<\\/a>#", 'nav link points to ajax demo' );
TapTest::isa( $dom->getElementsByTagName('form'), 'DOMNodeList', 'form dom element is present');
