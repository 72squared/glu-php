<?
// if we didn't get a command, go to the prompt.
if( ! $this->line ) {
    // give a new prompt
    $this->dispatch('prompt.php');
    
    // loop back.
    return TRUE;
}

// wrap in a try/catch block
try {
    // convert the line to a file
    $file = 'action/' .  preg_replace("/[^a-z0-9]/", "", strtolower($this->line)) . '.php';
    
    // run the file.
    if( $this->dispatch( $file  ) === FALSE ) return FALSE;
    
// oops! looks like we hit a problem.
} catch( Exception $e ){

    // attach the exception
    $this->exception = $e;
    
    // display the error.
    $this->dispatch('error.php');
    
    // clean up the exception.
    unset( $this->exception );
}

// print out the prompt again.
$this->dispatch('prompt.php');

// all is well.
return TRUE;

// EOF
