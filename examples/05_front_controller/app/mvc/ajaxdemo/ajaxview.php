<?
If( function_exists( 'json_encode') ){
    print json_encode( $input->request->export() );
} else {
    print_r( $input->request->export() );
}
// EOF;