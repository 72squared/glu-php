<?
if( ! $this->headers ) return;
foreach( $this->headers as $k=>$v ) {
    if( is_numeric( $k ) ) {
        header($v);
    } else {
        header($k . ': ' . $v);
    }
}
unset( $this->headers );
