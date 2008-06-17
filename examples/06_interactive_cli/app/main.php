<?
//find the current dir
$cwd = dirname(__FILE__);

// set up the line variable
$line = '';

// sit in an loop, running dispatch, and read from STDIN
while( self::dispatch($cwd . '/run.php', array('line'=>$line) ) ) {
    $line = trim( fgets( $input->STDIN ) );
}

// EOF