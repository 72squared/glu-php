<?
// This demo shows how to build a very simple html template

// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// include the grok class
include 'grok.php';

// kick off the main grok.
Grok::instance()->dispatch('lib/main');

// EOF