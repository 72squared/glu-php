<?php
$key = '_' . md5(__FILE__);

if( $this->$key ) return $this->$key;

$s = $this->dispatch(ROOT_DIR . 'load/server');
$path = str_replace( $this->dispatch(ROOT_DIR . 'load/baseurl'), '', $s->REQUEST_URI);
if( ( $pos = strpos( $path, '?' ) ) !==FALSE) $path = substr( $path, 0, $pos );
$path = preg_replace( '/[^a-z0-9\/\_\-\.]/', '', $path );
$path = trim($path, ' /');
return $this->$key = '/' . $path;

// EOF