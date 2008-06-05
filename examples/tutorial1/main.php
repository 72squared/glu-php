<?

// If you understand this demo, you can understand any of the more complex examples.

// include the grok class
include '../../grok.php';

// instantiate the grok
$grok = new Grok;

// set the app
$grok->app = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib';

// run a dispatch and send a greeting to the file
$result = $grok->dispatch('hello', array('greeting'=>'hello') );

// print out the result.
print( "\n" .  $result . "\n" );

// all done. 

