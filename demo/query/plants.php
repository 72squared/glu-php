<?

// DSN
$dsn = $this->dispatch('dsn/grok');

// sqlite db
$db = $this->dispatch('db/sqlite', $dsn );

// statement
$statement = 'SELECT * from plants';

// run the query
$rs = $db->query($statement);

// initialize the rows
$names = array();

// pull down all the rows.
while( $row = $rs->fetch() ){
    $names[] = $row['plant_name'];
}

// all done.
return $names;

// EOF
