<?
// if we got a name, build a greeting.
// and set a flag saying we got a name
if( $input->name ) return self::instance( array( 'greeting'=>'Howdy, ' . $input->name, 'name_posted'=>TRUE ) );

// or prompt to enter a name
return self::instance( array('greeting'=>'Enter your name below'));


// EOF