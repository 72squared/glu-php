<?

// make sure we have the sqlite extension installed
if( ! class_exists( SQLiteDatabase ) ) {
    throw $this->exception('sqlite database extension not installed for php');
}

// instantiate the db
$db = new SQLiteDatabase(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'test.db', '0666', $err = NULL );

// if there was a problem, blow up
if( $err ){
    throw $this->exception( sprintf("db connection failed: %s", $err) );
}

// return the db object for use
return $db;

// EOF