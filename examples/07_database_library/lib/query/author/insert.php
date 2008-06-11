<?

// make a template for the query
$tpl = "INSERT INTO author (first, last) VALUES ('%s', '%s')";

// assemble the query
$stmt = sprintf($tpl, sqlite_escape_string( $this->first ), sqlite_escape_string( $this->last ));

// connect to the db
$db = $this->dispatch('database/test.php');

// run the query
$rs = $db->query($stmt, NULL, $err = NULL);

// check for errors
if( $err ) throw $this->exception('query error: ' . $err );

// return the insert id
return $db->lastInsertRowid();

// EOF