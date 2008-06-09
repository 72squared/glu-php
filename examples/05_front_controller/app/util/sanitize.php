<?
// make sure we can actually filter.
if( ! function_exists('filter_var') ) return $input;

// create a new container so we can put all the sanitized content inside
$data = $this->instance();

// loop throug all the input
foreach( $input->export() as $key=>$value) {
    // sanitize each variable and assign it to the new container.
    $data->$key = filter_var( $value, FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR | FILTER_FLAG_STRIP_LOW );
}

// return the container, all cleaned up!
return $data;

// EOF