<?
// build the sql.
$stmt = 'CREATE TABLE author( id INTEGER PRIMARY KEY, first TEXT(50), last TEXT(50) )';

// get the db object.
$db = $this->dispatch('database/test');

// run the query
$rs = $db->query($stmt, NULL, $err = NULL);

// check for an error.
if( $err ) throw new Exception('query error: ' . $err );

// DONE.
return TRUE;

// EOF