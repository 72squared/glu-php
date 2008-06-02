<?
// You can build almost anything with GROK, once you get a few basic concepts under your belt.
// Because Grok is so simple and flexible, it lends it self to all kinds of purposes. Here we
// are illustrating a very basic MVC application.
// Everything boils down to this concept: INPUT --> PROCESS --> OUTPUT
// This script does most of the work, and i don't really try to hide any magic inside GROK.
// Yes, that means you have to spend slightly more time doing setup, but in the end, that means
// you can easily change it later without having to change lots inside the core.

// let's start timing so that later we can display how long it took to run our app.
// this will include the amount of time it took to include the grok framework.
$start = microtime(TRUE);

// include the grok class. That's right, there is only one class, and it is tiny.
include 'grok.php';

// instantiate the grok.
// pretty simple, eh?
// if you wanted to prepopulate the controller with some variables you could pass those
// in to the constructor as an array of key/value pairs.
// i prefer to assign them as i go along so I can tell you what i am doing.
$controller = new Grok;

// set the application directory.
// the app variable is the only 'magic' variable.
// we use it to determine the path to the app directory.
// i am using an absolute path, but you can use a relative one if you want
$controller->app = dirname(__FILE__) . DIRECTORY_SEPARATOR .  'demo';

// i can put arbitrary data into the controller that can be consumed by the app.
// the only other data in the controller is that 'app' path, and the rest is free to be used.
// let's put the start time into the controller as an example.
// you could just as easily attach a url parsing object, a database object, 
// or any other set of useful tools that you might need in your app.
$controller->start = $start;

// set up the input ... we are gonna pre-populate a variable called route.
// there is nothing special about the route variable.
// i just decided to use that variable in the code below to trigger off some actions and
// views that are paired together. Grok Controller knows nothing about the route variable in the
// input. The code below tells actions and views to be triggered based on that, and i have set
// up some appropriate files in my demo app to handle based on the schema i just made  up here.
// you could bend the rules for how your app is run just by tweaking this entry point.
$input = new Grok( array('route'=>'index') );

// now i want to import the request, and while i am at it, sanitize all the variables inside.
// using the built-in pecl filter_var function. i could just pass the request straight in, but
// it is a bit safer to sanitize it all first as a precaution, and it is easy to do.
// we could make up any number of sanitizers and filters. this was a quick and dirty one to 
// illustrate the point more than actually indicate how it should be used in production.
$request = $controller->dispatch('filter/sanitize', $_REQUEST);

// now, overlay the request.
// this quite possibly changed the route to something else. but at least we have
// a default. We could also customize this by importing other arrays to
// overlay on top of this. use your imagination.
// you might parse the URL querystring coming in, and use that to populate
// the route.
$input->import( $request );

// we are gonna wrap in a try catch block here.
// the reason is that in case our route doesn't exist  or some other include doesn't work, 
// we can easily catch the problem and go to an error view instead of just crashing in a
// Fatal Error in the script. 
try {
    // render the page
    $controller->dispatch( 'controller/' . $controller->dispatch('filter/controller_url'), $input );

// catch any exceptions
} catch( Exception $e ){

    // what happened? put the exception into the input
    // we can use it in the error template.
    $input->exception = $e;
    
    // nothing much left to do.
    // render the error view
    return $controller->dispatch('controller/error', $input );
}

// all done!
// as you can see, a pretty simplistic application framework, mostly run by convention. if you
// keep your code simple and think of innovative ways to use this, nothing can stop you!

// EOF