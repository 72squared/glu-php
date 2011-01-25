<?
class IMAP_Auth extends GLU {
    protected $debug = array();
    
    public function __construct( $host, $secure = FALSE ){
        if( ! $secure ){
            $scheme = 'tcp';
            $port = 143;
        } else {
            $scheme = 'ssl';
            $port = 993;
        }
        
        $errno = $errstr = NULL;
        $path =  $scheme . '://' . $host . ':' . $port;
        $this->debug[] = $path;
        $this->stream = @stream_socket_client( $path, $errno, $errstr, 2 );
        if( ! is_resource( $this->stream ) ) throw new Exception( $this->debug[] = 'pop3-conn-fail:' . $errno . '-' . $errstr);
        stream_set_timeout($this->stream, 1);
        $response = $this->debug[] = fgets( $this->stream);
        if( strpos(substr($response, 0, 10), 'OK') === FALSE) throw new Exception( $this->debug[] = 'pop3-comm-fail:' . $response);
    }
    
    public function authenticate( $username, $password ){
        fwrite($this->stream, $this->debug[] = 'a001 LOGIN ' . $username . ' ' . $password . "\r\n");
        $response = $this->debug[] = fgets( $this->stream);
        if( strpos(substr($response, 0, 10), 'OK') === FALSE) throw new Exception( $this->debug[] = 'pop3-comm-fail:' . $response);
        return TRUE;
    }
    
    function __destruct(){
        if( $this->stream ) fclose($this->stream);
        unset($this->stream);
    }
}

// EOC