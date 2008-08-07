<?
class Pop3_Auth extends Grok {
    protected $debug = array();
    
    public function __construct( $host, $secure = FALSE ){
        if( ! $secure ){
            $scheme = 'tcp';
            $port = 110;
        } else {
            $scheme = 'ssl';
            $port = 995;
        }
        
        $errno = $errstr = NULL;
        $path =  $scheme . '://' . $host . ':' . $port;
        $this->debug[] = $path;
        $this->stream = @stream_socket_client( $path, $errno, $errstr, 2 );
        if( ! is_resource( $this->stream ) ) throw new Exception( $this->debug[] = 'pop3-conn-fail:' . $errno . '-' . $errstr);
        stream_set_timeout($this->stream, 1);
        $response = $this->debug[] = fgets( $this->stream);
        if( substr($response, 0, 3) != '+OK') throw new Exception( $this->debug[] = 'pop3-comm-fail:' . $response);
    }
    
    public function authenticate( $username, $password ){
        fwrite($this->stream, $this->debug[] = 'USER ' . $username . "\r\n");
        $response = $this->debug[] = fgets( $this->stream);
        if( substr($response, 0, 3) != '+OK' ) throw new Exception($this->debug[] = 'pop3-invalid-user:' . $response);
        fwrite($this->stream, $this->debug[] = 'PASS ' . $password . "\r\n");
        $response = $this->debug[] = fgets( $this->stream);
        if( substr($response, 0, 3) != '+OK') throw new Exception($this->debug[] = 'pop3-invalid-pass:' . $response);
        return TRUE;
    }
    
    function __destruct(){
        if( $this->stream ) fclose($this->stream);
        unset($this->stream);
    }
}

// EOC