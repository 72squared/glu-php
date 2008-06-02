<?
// create a new container so we can put all the sanitized content inside
$data = new Grok;

// loop throug all the input
foreach( $input->keys() as $key ) {
    // sanitize each variable and assign it to the new container.
    $data->$key = filter_var( $input->$key, FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR | FILTER_FLAG_STRIP_LOW );
}

// return the container, all cleaned up!
return $data;

// EOF