<?php
//find the current dir
$cwd = dirname(__FILE__);

// run a dispatch and send a greeting to the first level.
// the first level hello will pass it further inward and return it back.
$result = $this->instance( array('greeting'=>'hello') )->dispatch($cwd . '/level1/hello.php' );

// print out the result.
print( "\n" .  $result . "\n" );