<?
// You can build almost anything with GROK, once you get a few basic concepts under your belt.
// Because Grok is so simple and flexible, it lends it self to all kinds of purposes. Here we
// are illustrating a very basic MVC application.
// Everything boils down to this concept: INPUT --> PROCESS --> OUTPUT
// This script does most of the work, and i don't really try to hide any magic inside GROK.
// Yes, that means you have to spend slightly more time doing setup, but in the end, that means
// you can easily change it later without having to change lots inside the core.


// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// let's start timing so that later we can display how long it took to run our app.
// this will include the amount of time it took to include the grok framework.
$start = microtime(TRUE);

// include the grok class. 
// we put a symlink to the real grok class. This shows where you would normally put
// the grok class.
// the nice thing is that grok class file is completely portable and there is only one file
// you have to worry about.
include 'class' . DIRECTORY_SEPARATOR . 'grok.php';


// kick off the main include. pass in the start time.
Grok::instance()->dispatch('app/main', array('start'=>$start ) );

// all done.


// EOF