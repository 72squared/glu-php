<?
// create a template for the query.
$tpl = "UPDATE author SET first = '%s', last= '%s' WHERE id = %d";

// assemble the statement
$stmt = sprintf($tpl, sqlite_escape_string( $this->first ), sqlite_escape_string( $this->last ), $this->id);

// connect to the db.
$db = $this->dispatch('database/test.php');

// run the query
$rs = $db->query($stmt, NULL, $err = NULL);

// check for errors.
if( $err ) throw $this->exception('query error: ' . $err );

// success!
return TRUE;

//EOF;