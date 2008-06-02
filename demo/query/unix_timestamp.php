<?
// get the dsn
$dsn = $this->dispatch('dsn/test');

// get the db object.
$db = $this->dispatch('db/mysqli', $dsn );

// build the query string
$statement = sprintf("SELECT UNIX_TIMESTAMP('%s') as ts", $db->escape_string($input->datetime));

// run my query
$rs = $db->query($statement);

// validate the result
if( ! $rs ) throw new Exception( sprintf("query error: %s", $db->error) );

// fetch the row.
$row = $rs->fetch_object();

// clean up the rs object
$rs->close();

// return the timestamp
return $row->ts;

// EOF