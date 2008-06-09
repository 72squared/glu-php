<?
// i am gonna turn on an output buffer so in case something bad happens mid-view render, i can
// discard it all and start over.
ob_start();

// we are gonna wrap in a try catch block.
// the reason is that in case our route doesn't exist  or some other include doesn't work, 
// we can easily catch the problem and go to an error view instead of just crashing in a
// Fatal Error in the script. 
try {

    // gather all the request variables, and while i am at it, sanitize it all
    // using the built-in pecl filter_var function. i could just pass the request straight in, but
    // it is a bit safer to sanitize it all first as a precaution, and it is easy to do.
    // we could make up any number of sanitizers and filters. this was a quick and dirty one to 
    // illustrate the point more than actually indicate how it should be used in production.
    $input->import( $this->dispatch('/util/sanitize', $_REQUEST) );
    
    // determine which controller to call.
    $route = $this->dispatch('/util/extract_route');
    
    // call the controller. 
    $this->dispatch( '/mvc/' . $route . '/controller', $input );
    
// catch any exceptions
} catch( Exception $e ){

    // what happened? put the exception into the input
    // we can use it in the error template.
    $input->exception = $e;
    
    // let's grab everything so far in the output buffer
    $input->debug = ob_get_contents();
    
    // now clear the output buffer so we have a clean slate
    ob_end_clean();
    
    // start up the buffer again.
    ob_start();
    
    // nothing much left to do but render an error page
    return $this->dispatch('/layout/error', $input );
}

// all done rendering: flush it out!
ob_flush();

// EOF