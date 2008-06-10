<?

// instantiate the grok with the current working directory.
// run a dispatch and send a greeting to the file.
// capture the response.
$result = $this->instance()->dispatch('hello', array('greeting'=>'hello') );

// print out the result.
print( "\n" .  $result . "\n" );

// EOF