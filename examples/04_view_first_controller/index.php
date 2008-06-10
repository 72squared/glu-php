<?
// Example of a view-first controller


// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// let's start timing so that later we can display how long it took to run our app.
// this will include the amount of time it took to include the grok framework.
$start = microtime(TRUE );

// include an auto-load function for classes, so that we can
// put all of our related classes into this directory and they
// will be automagically included for us.
include 'class' . DIRECTORY_SEPARATOR . '__autoload.php';

// We are making a view-first controller, so let's determine our view, shall we? I am calling
// a short snippet that tells me what the name of my view is based on the current url.
$view = Grok::instance()->dispatch('app/lib/extract_view', $_SERVER);

// kick off the app.
// since grok is in the directory (as a symlink), when we start using the grok class here, the main
// grok file is automatically included. later, when we call other classes in our mvc, those classes
// will be automatically included for us as well on the fly.
Grok::instance( array('view'=>$view, 'start'=>$start) )->dispatch('app/main', $_REQUEST);

// EOF