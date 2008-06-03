<?

// get the db via dsn
$db = $this->dispatch('dsn/grok');

// statement
$statement = 'SELECT * from plants';

// run the query
$rs = $db->query($statement, SQLITE_BOTH, $error_msg = NULL );

// make sure an error didn't happen.
if( $error_msg ) {
    throw new Exception('query-error: ' . $error_msg );
}

// all done. return the query result object
return $rs;

// EOF
