<?
// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// let's start timing so that later we can display how long it took to run our app.
// this will include the amount of time it took to include the grok framework.
$start = microtime(TRUE );

// include the grok class. 
// in this case, we have a symlink to the actual class file. 
// this makes it easier to demonstrate where to place the different files.
include 'class' . DIRECTORY_SEPARATOR . 'grok.php';

// kick it off.
Grok::instance()->dispatch('app/main', array('start'=>$start));

// EOF