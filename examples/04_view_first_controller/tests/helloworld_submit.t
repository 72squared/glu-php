#!/usr/bin/env php
<?php
chdir( dirname(__FILE__)  );
$view = 'helloworld';
$input = array('name'=>'stranger');
include 'base.php';

TapTest::plan(11);
TapTest::like($output, '/<html>/', 'output is html' );
TapTest::like($dom->getElementsByTagName('title')->item(0)->nodeValue, '/Hello, World/i', 'title says hello' );
TapTest::like($dom->getElementsByTagName('title')->item(0)->nodeValue, '/glu app/i', 'title says glu app');
TapTest::like($dom->getElementsByTagName('h1')->item(0)->nodeValue, '/view-first/i', 'h1 tag says view-first');
TapTest::like($dom->getElementsByTagName('h2')->item(0)->nodeValue, '/Hello, World!/i', 'h2 tag says hello' );
TapTest::like($output, '/Howdy, stranger/i', 'output says howdy, stranger');
TapTest::like( $output, '/page generated in ([+-]?\\d*\\.\\d+)(?![-+0-9\\.]) seconds/i', 'page generated time in message' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/index\">Home<\\/a>#", 'nav link points home' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/helloworld\">Hello World<\\/a>#", 'nav link points to hello world' );
TapTest::like( $output, "#<a href=\"([a-z-0-9_\.\/]+)\\/intro\">Introduction<\\/a>#", 'nav link points to intro' );
TapTest::isa( $dom->getElementsByTagName('form'), 'DOMNodeList', 'form dom element is present');
