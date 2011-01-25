<?php
// This demo shows how to build a very simple html template

//find the current dir
$cwd = dirname(__FILE__);

// include the glu class
include $cwd . DIRECTORY_SEPARATOR . 'glu.php';

// kick off the main glu.
GLU::instance()->dispatch($cwd . '/lib/main.php');

// EOF