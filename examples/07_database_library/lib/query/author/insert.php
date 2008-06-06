<?

// make a template for the query
$tpl = "INSERT INTO author (first, last) VALUES ('%s', '%s')";

// assemble the query
$stmt = sprintf($tpl, sqlite_escape_string( $input->first ), sqlite_escape_string( $input->last ));

// connect to the db
$db = $this->dispatch('database/test');

// run the query
$rs = $db->query($stmt, NULL, $err = NULL);

// check for errors
if( $err ) throw new Exception('query error: ' . $err );

// return the insert id
return $db->lastInsertRowid();

// EOF