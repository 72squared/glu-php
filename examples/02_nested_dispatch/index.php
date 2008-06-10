<?
// This demo shows how you can nest groks. 
// in other words, one grok can instantiate an dispatch another.
// which allows you to create a complex nested and encapsulated
// components.

// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// include the grok class
include 'grok.php';

// kick off the main grok
Grok::instance()->dispatch('lib/main');

// all done. 

// EOF