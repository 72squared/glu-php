<?
// an example of a CLI app.

//find the current dir
$cwd = dirname(__FILE__);

// make sure we are running from cli.
if( ! is_resource( STDIN ) ){
    // exit with an error message for the web browser.
    die('<h1>Please run this from CLI.</h1><h2>Does not work in browser.</h2>');
}

// set the current working directory.
chdir( dirname(__FILE__) );

// include grok
include 'grok.php';

// kick it off, reading from STDIN
Grok::dispatch($cwd . '/app/main.php', array('STDIN'=>STDIN) );

// EOF
