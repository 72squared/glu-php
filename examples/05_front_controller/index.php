<?
// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// let's start timing so that later we can display how long it took to run our app.
// this will include the amount of time it took to include the grok framework.
$start = microtime(TRUE );

// include the grok class. That's right, there is only one class, and it is tiny.
include '../../grok.php';

// kick it off.
Grok::instance(array('start'=>$start))->dispatch('app/main');

// EOF