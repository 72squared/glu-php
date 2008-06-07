<?
// This demo shows how you can nest groks. 
// in other words, one grok can instantiate an dispatch another.
// which allows you to create a complex nested and encapsulated
// components.

// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// include the grok class
include '../../grok.php';

// instantiate the grok and set the app
$grok = new Grok('level1');

// run a dispatch and send a greeting to the first level.
// the first level hello will pass it further inward and return it back.
$result = $grok->dispatch('hello', array('greeting'=>'hello') );

// print out the result.
print( "\n" .  $result . "\n" );

// all done. 

// EOF