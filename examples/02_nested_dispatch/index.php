<?php
// This demo shows how you can nest glus. 
// in other words, one glu can instantiate an dispatch another.
// which allows you to create a complex nested and encapsulated
// components.

//find the current working dir
$cwd = dirname(__FILE__);

// include the glu class
include $cwd . DIRECTORY_SEPARATOR . '/glu.php';

// kick off the main glu
GLU::instance()->dispatch($cwd . '/lib/main.php');

// all done. 

// EOF