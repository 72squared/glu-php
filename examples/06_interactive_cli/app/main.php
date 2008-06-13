<?
//find the current dir
$cwd = dirname(__FILE__);

// sit in an loop, running dispatch, and read from STDIN
while( $this->dispatch($cwd . '/run.php') ) {
    $this->line = trim( fgets( $this->STDIN ) );
}

// EOF