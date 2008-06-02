<?
// get the dsn
$dsn = $this->dispatch('dsn/test');

// get the db object.
$db = $this->dispatch('db/mysqli', $dsn );

// build the query string.
$statement = sprintf("SELECT CRC32('%s') as crc", $db->escape_string($input->string) );

// run the query
$rs = $db->query( $statement );

// validate the result
if( ! $rs ) throw new Exception( sprintf("query error: %s", $db->error) );

// get the row as an object
$row = $rs->fetch_object();

// clean up the query result set
$rs->close();

// return the checksum
return $row->crc;

// EOF