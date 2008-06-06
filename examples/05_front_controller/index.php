<?
// You can build almost anything with GROK, once you get a few basic concepts under your belt.
// Because Grok is so simple and flexible, it lends it self to all kinds of purposes. Here we
// are illustrating a very basic web application.
// Everything boils down to this concept: INPUT --> PROCESS --> OUTPUT
// This script does most of the work, and i don't really try to hide any magic inside GROK.
// Yes, that means you have to spend slightly more time doing setup, but in the end, that means
// you can easily change it later without having to change lots inside the core.

// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// let's start timing so that later we can display how long it took to run our app.
// this will include the amount of time it took to include the grok framework.
$start = microtime(TRUE );

// include the grok class. That's right, there is only one class, and it is tiny.
include '../../grok.php';

// instantiate the grok.
// we pass in the path to our application directory.
// we use it in dispatch to locate the rest of the includes.
// i am using an absolute path, but you can use a relative one if you want
$runner = new Grok('app');

// i can put arbitrary data into the controller that can be consumed by the app.
// let's put the start time into the controller as an example.
// you could just as easily attach a url parsing object, a database object, 
// or any other set of useful tools that you might need in your app.
$runner->start = $start;

// kick off the application runner.
$runner->dispatch('main');

// all done!
// as you can see, a pretty simplistic mvc front-end controller, mostly run by convention. if you
// keep your code simple and think of innovative ways to use this, nothing can stop you!

// EOF