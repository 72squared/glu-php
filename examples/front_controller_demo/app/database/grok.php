<?

// make sure we have the sqlite extension installed
if( ! class_exists( SQLiteDatabase ) ) {
    throw new Exception('sqlite database extension not installed for php');
}

// instantiate the db
$db = new SQLiteDatabase( str_replace( '/', DIRECTORY_SEPARATOR, $this->__app . '/database/grok.db'), 
                          '0666',
                          $error_message = NULL
                );

// if there was a problem, blow up
if( !db ){
    throw new Exception( sprintf("db connection failed: %s", $error_message) );
}

// return the db object for use
return $db;

// EOF