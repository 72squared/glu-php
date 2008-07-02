<?
//find the current dir
$cwd = dirname(__FILE__);
$vars = array();
foreach( $this->request as $k=>$v ) $vars[$k] = $v;
If( function_exists( 'json_encode') ){
    print json_encode( $vars );
} else {
    print_r( $vars);
}
// EOF;