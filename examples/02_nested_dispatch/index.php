<?php
// This demo shows how you can nest groks. 
// in other words, one grok can instantiate an dispatch another.
// which allows you to create a complex nested and encapsulated
// components.

//find the current working dir
$cwd = dirname(__FILE__);

// include the grok class
include $cwd . DIRECTORY_SEPARATOR . '/grok.php';

// kick off the main grok
Grok::instance()->dispatch($cwd . '/lib/main.php');

// all done. 

// EOF