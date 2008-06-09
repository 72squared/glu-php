<?
// build the sql statement.
$stmt = 'DROP TABLE author';

// connect to the db
$db = $this->dispatch('database/test');

// run the query
$rs = $db->query($stmt, NULL, $err = NULL);

// check for an error
if( $err ) throw $this->exception('query error: ' . $err );

// all done.
return TRUE;

// EOF