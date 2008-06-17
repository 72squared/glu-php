<?
//find the current dir
$cwd = dirname(__FILE__);

// instantiate the grok with the current working directory.
// run a dispatch and send a greeting to the file.
// capture the response.
$result = self::dispatch($cwd . '/hello.php', array('greeting'=>'hello'));

// print out the result.
print( "\n" .  $result . "\n" );

// EOF