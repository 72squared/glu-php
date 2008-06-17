<?
//find the current dir
$cwd = dirname(__FILE__);

// if we didn't get a command, go to the prompt.
if( ! $input->line ) {
    // give a new prompt
    self::dispatch($cwd . '/prompt.php');
    
    // loop back.
    return TRUE;
}

// wrap in a try/catch block
try {
    // convert the line to a file
    $file = $cwd . '/action/' .  preg_replace("/[^a-z0-9]/", "", strtolower($input->line)) . '.php';
    
    // run the file.
    if( self::dispatch( $file ) === FALSE ) return FALSE;
    
// oops! looks like we hit a problem.
} catch( Exception $e ){
    
    // display the error.
    self::dispatch($cwd . '/error.php', array('exception'=>$e ) );
}

// print out the prompt again.
self::dispatch($cwd . '/prompt.php');

// all is well.
return TRUE;

// EOF
