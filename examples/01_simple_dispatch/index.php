<?php
// If you understand this demo, you can understand any of the more complex examples.

// find the current working dir.
$cwd = dirname(__FILE__);

// include the glu class
include $cwd . DIRECTORY_SEPARATOR . 'glu.php';

// run main.
GLU::instance()->dispatch( $cwd . '/lib/main.php');

// all done. 

