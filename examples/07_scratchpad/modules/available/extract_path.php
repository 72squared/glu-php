<?php
if( $this->path ) return;
$path = str_replace( $this->baseurl, '', $this->server->REQUEST_URI);
if( ( $pos = strpos( $path, '?' ) ) !==FALSE) $path = substr( $path, 0, $pos );
$this->path = $path;