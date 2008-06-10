<?

// run a dispatch and send a greeting to the first level.
// the first level hello will pass it further inward and return it back.
$result = $this->instance()->dispatch('level1/hello', array('greeting'=>'hello') );

// print out the result.
print( "\n" .  $result . "\n" );