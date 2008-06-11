<?
// This demo shows how to build a very simple factory method of instantiation, and to keep
// singleton instances of the object available. this example is not very useful but might give
// ideas on how the pattern could be used for other real-life purposes.

// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// include the grok class
include 'grok.php';

// run the main script
Grok::instance()->dispatch('lib/main.php');

// EOF