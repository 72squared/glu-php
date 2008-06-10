<?
// make sure we are on the script.
if( strpos( $input->REQUEST_URI, $input->SCRIPT_NAME ) === FALSE ) return 'index';

// extract the view name from the request URI
$view = trim( str_replace( $input->SCRIPT_NAME, '', $input->REQUEST_URI), ' /');

// trim off the GET params
if( $pos = strpos( $view, '?' ) ) $view = substr( $view, 0, $pos );

// get rid of any dangerous characters.
$view = preg_replace( '/[^a-z0-9\/\_]/', '', $view );

// if no view was specified, return the default characters
if( ! $view ) return 'index';

// all done.
return $view;

// EOF