<?
// If you understand this demo, you can understand any of the more complex examples.

// find the current working dir.
$cwd = dirname(__FILE__);

// include the grok class
include $cwd . DIRECTORY_SEPARATOR . 'grok.php';

// run main.
Grok::dispatch( $cwd . '/lib/main.php');

// all done. 

