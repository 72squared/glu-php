<?

// If you understand this demo, you can understand any of the more complex examples.

// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// include the grok class
include '../../grok.php';

// instantiate the grok
// set the app
$grok = new Grok('lib');

// run a dispatch and send a greeting to the file
$result = $grok->dispatch('hello', array('greeting'=>'hello') );

// print out the result.
print( "\n" .  $result . "\n" );

// all done. 

