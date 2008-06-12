<?

// sit in an loop, running dispatch, and read from STDIN
while( $this->dispatch('run.php') ) {
    $this->line = trim( fgets( $this->STDIN ) );
}

// EOF