<?
if( ! is_array( $this->headers ) ) return;
foreach( $this->headers as $header ) header($header);
unset( $this->headers );
