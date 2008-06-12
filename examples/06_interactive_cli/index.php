<?
// an example of a CLI app.

// make sure we are running from cli.
if( ! is_resource( STDIN ) ){
    // exit with an error message for the web browser.
    die('<h1>Please run this from CLI.</h1><h2>Does not work in browser.</h2>');
}

// set the current working directory.
chdir( dirname(__FILE__) );

// include grok
include 'grok.php';

// kick it off
Grok::instance()->dispatch('app/main.php');


// EOF