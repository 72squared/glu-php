<?
//find the current dir
$cwd = dirname(__FILE__);// This demo shows how to build a very simple html template

//find the current dir
$cwd = dirname(__FILE__);

// include the grok class
include $cwd . DIRECTORY_SEPARATOR . 'grok.php';

// kick off the main grok.
Grok::instance()->dispatch($cwd . '/lib/main.php');

// EOF