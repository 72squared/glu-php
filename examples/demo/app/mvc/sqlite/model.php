<?
// get the db via dsn
$db = $this->dispatch('database/grok');

// statement
$statement = 'SELECT * from plants';

// run the query
$rs = $db->query($statement, SQLITE_BOTH, $error_msg = NULL );

// make sure an error didn't happen.
if( $error_msg ) {
    throw new Exception('query-error: ' . $error_msg );
}
 
// initialize the list of plant names
$plants = array();
 
// pull down all the plant names.
while( $row = $rs->fetch() ) $plants[] = $row['plant_name'];

// return the list of plants.
return new self( array('plants'=> $plants ) );

// EOF