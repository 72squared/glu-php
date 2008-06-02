<?

// make sure we have the mysqli extension installed
if( ! class_exists( mysqli ) ) {
    throw new Exception('mysqli database extension not installed for php');
}

// create a handy little connection string hash
$db_key = 'db_mysqli_' . md5(   $input->host . '|' . 
                                $input->username . '|' . 
                                $input->passwd . '|' . 
                                $input->dbname . '|' . 
                                $input->port . '|' . 
                                $input->socket );

// we can check to see if we have used this connection before.
// if so, we can re-use it
if( $this->$db_key instanceof mysqli ) return $this->$db_key;

// instantiate the db
$db = new mysqli(   $input->host, 
                    $input->username,  
                    $input->passwd, 
                    $input->dbname, 
                    $input->port, 
                    $input->socket );

// if there was a problem, blow up
if(mysqli_connect_errno()){
    throw new Exception( sprintf("db connection failed: %s", mysqli_connect_error()) );
}

// cache the db object for later
$this->db_key = $db;

// return the db object for use
return $db;

// EOF