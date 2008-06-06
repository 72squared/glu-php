<?

// make sure we have the sqlite extension installed
if( ! class_exists( SQLiteDatabase ) ) {
    throw new Exception('sqlite database extension not installed for php');
}

// instantiate the db
$db = new SQLiteDatabase('test.db', '0666', $err = NULL );

// if there was a problem, blow up
if( $err ){
    throw new Exception( sprintf("db connection failed: %s", $err) );
}

// return the db object for use
return $db;

// EOF