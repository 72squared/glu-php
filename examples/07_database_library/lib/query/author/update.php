<?
// create a template for the query.
$tpl = "UPDATE author SET first = '%s', last= '%s' WHERE id = %d";

// assemble the statement
$stmt = sprintf($tpl, sqlite_escape_string( $input->first ), sqlite_escape_string( $input->last ), $input->id);

// connect to the db.
$db = $this->dispatch('database/test');

// run the query
$rs = $db->query($stmt, NULL, $err = NULL);

// check for errors.
if( $err ) throw new Exception('query error: ' . $err );

// success!
return TRUE;

//EOF;