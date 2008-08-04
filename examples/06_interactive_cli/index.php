<?php
// an example of a CLI app.

//find the current dir
$cwd = dirname(__FILE__) . DIRECTORY_SEPARATOR;

// make sure we are running from cli.
if( ! is_resource( STDIN ) ){
    // exit with an error message for the web browser.
    die('<h1>Please run this from CLI.</h1><h2>Does not work in browser.</h2>');
}

// include grok
include $cwd . 'grok.php';

// kick it off, reading from STDIN
Grok::instance(array('STDIN'=>STDIN) )->dispatch($cwd . 'app/main.php');

// EOF
