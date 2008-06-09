<?
// build the statement
$stmt = "SELECT * FROM author";

// connect to the database
$db = $this->dispatch('/database/test');

// run the query
$rs = $db->query($stmt, NULL, $err = NULL);

// check for errors.
if( $err ) throw $this->exception('query error: ' . $err );

// return the result set iterator
return $rs;

// EOF