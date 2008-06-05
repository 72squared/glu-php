<?
// You can build almost anything with GROK, once you get a few basic concepts under your belt.
// Because Grok is so simple and flexible, it lends it self to all kinds of purposes. Here we
// are illustrating a very basic web application.
// Everything boils down to this concept: INPUT --> PROCESS --> OUTPUT
// This script does most of the work, and i don't really try to hide any magic inside GROK.
// Yes, that means you have to spend slightly more time doing setup, but in the end, that means
// you can easily change it later without having to change lots inside the core.

// let's start timing so that later we can display how long it took to run our app.
// this will include the amount of time it took to include the grok framework.
$start = microtime(TRUE );

// include the grok class. That's right, there is only one class, and it is tiny.
include '../../grok.php';

// instantiate the grok.
// pretty simple, eh?
// if you wanted to prepopulate the controller with some variables you could pass those
// in to the constructor as an array of key/value pairs.
// i prefer to assign them as i go along so I can tell you what i am doing.
$runner = new Grok;

// set the application directory.
// the app variable is the only 'magic' variable.
// we use it to determine the path to the app directory.
// i am using an absolute path, but you can use a relative one if you want
$runner->app = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'app';

// i can put arbitrary data into the controller that can be consumed by the app.
// the only other data in the controller is that 'app' path, and the rest is free to use.
// let's put the start time into the controller as an example.
// you could just as easily attach a url parsing object, a database object, 
// or any other set of useful tools that you might need in your app.
$runner->start = $start;

// kick off the controller
$runner->dispatch('mvc/main');

// all done!
// as you can see, a pretty simplistic application framework, mostly run by convention. if you
// keep your code simple and think of innovative ways to use this, nothing can stop you!

// EOF