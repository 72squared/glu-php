<?

// If you understand this demo, you can understand any of the more complex examples.

// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// include the grok class
include 'grok.php';

// run main.
Grok::instance()->dispatch('lib/main.php');

// all done. 

