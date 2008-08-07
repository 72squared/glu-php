<?php
$key = '_' . md5(__FILE__);

if( $this->$key ) return $this->$key;

$s = $this->dispatch(ROOT_DIR . 'load/server');

// extract the route name from the request URI
$path = str_replace( $this->dispatch(ROOT_DIR . 'load/baseurl'), '', $s->REQUEST_URI);

// trim off the GET params
if( ( $pos = strpos( $path, '?' ) ) !==FALSE) $path = substr( $path, 0, $pos );


// get rid of any dangerous characters.
$path = preg_replace( '/[^a-z0-9\/\_\-\.]/', '', $path );

// trim it up
$path = trim($path, ' /');

// all done.
return $this->$key = '/' . $path;

// EOF