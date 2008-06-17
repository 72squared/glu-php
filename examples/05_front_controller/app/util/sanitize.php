<?
//find the current dir
$cwd = dirname(__FILE__);// make sure we can actually filter.
if( ! function_exists('filter_var') ) return $input;

// loop throug all the current data
foreach( $input->export() as $key=>$value) {
    // sanitize each variable and assign it to the new container.
    $input->$key = filter_var( $value, FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR | FILTER_FLAG_STRIP_LOW );
}

return $input;
// EOF