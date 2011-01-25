<?php
//find the current dir
$cwd = dirname(__FILE__);

// instantiate the glu with the current working directory.
// run a dispatch and send a greeting to the file.
// capture the response.
$result = $this->instance(array('greeting'=>'hello'))->dispatch( $cwd . '/hello.php' );

// print out the result.
print( "\n" .  $result . "\n" );

// EOF