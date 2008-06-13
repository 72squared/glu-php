<?
//find the current dir
$cwd = dirname(__FILE__);
If( function_exists( 'json_encode') ){
    print json_encode( $this->request->export() );
} else {
    print_r( $this->request->export() );
}
// EOF;