<?

// make sure we have the sqlite extension installed
if( ! class_exists( SQLiteDatabase ) ) {
    throw new Exception('sqlite database extension not installed for php');
}

// build the file name.
$file =  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'test.db';

// instantiate the db
$db = new SQLiteDatabase( $file, '0666', $error_message = NULL );

// if there was a problem, blow up
if( !db ){
    throw new Exception( sprintf("db connection failed: %s", $error_message) );
}

// return the db object for use
return $db;

// EOF