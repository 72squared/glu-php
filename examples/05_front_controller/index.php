<?php
// Example of a front-end controller

//find the current dir
$cwd = dirname(__FILE__);

// let's start timing so that later we can display how long it took to run our app.
// this will include the amount of time it took to include the grok framework.
$start = microtime(TRUE );

// include an auto-load function for classes, so that we can
// put all of our related classes into this directory and they
// will be automagically included for us.
include 'class' . DIRECTORY_SEPARATOR . '__autoload.php';

// determine which controller to call.
$route = Grok::instance($_SERVER)->dispatch( Dir::util . 'extract_route.php');

// kick off the app.
// since grok is in the directory (as a symlink), when we start using the grok class here, the main
// grok file is automatically included. later, when we call other classes in our mvc, those classes
// will be automatically included for us as well on the fly.
Grok::instance( array('start'=>$start, 'route'=>$route, 'request'=>$_REQUEST) )->dispatch( Dir::app . 'main.php');

// EOF