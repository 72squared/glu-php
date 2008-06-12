<?
// print out the help screen.
$this->dispatch('help.php');

// print the prompt:
$this->dispatch('prompt.php');


// sit in an endless loop.
while( TRUE ){
    // read from standard input
    $line = trim( fgets( STDIN ) );
    
    // if we didn't get a command, go to the prompt.
    if( ! $line ) {
        // give a new prompt
        $this->dispatch('prompt.php');
        
        // loop back.
        continue;
    }
    
    // wrap in a try/catch block
    try {
        // run the line.
        $this->dispatch( $line . '.php' );
        
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
}


// EOF