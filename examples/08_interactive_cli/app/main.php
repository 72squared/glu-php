<?

// create the app runner.
$runner = $this->instance();

// print out the help screen.
$runner->dispatch('help' );

// print the prompt:
$runner->dispatch('prompt');


// sit in an endless loop.
while( TRUE ){
    // read from standard input
    $line = trim( fgets( STDIN ) );
    
    // if we didn't get a command, go to the prompt.
    if( ! $line ) {
        // give a new prompt
        $runner->dispatch('/prompt');
        
        // loop back.
        continue;
    }
    
    // wrap in a try/catch block
    try {
        // run the line.
        $runner->dispatch( $line );
        
    // oops! looks like we hit a problem.
    } catch( Exception $e ){
        // attach the exception
        $runner->exception = $e;
        
        // display the error.
        $runner->dispatch('error');
        
        // clean up the exception.
        unset( $runner->exception );
    }
    
    // print out the prompt again.
    $runner->dispatch('prompt');
}


// EOF