<?php

class HttpAuthDigest extends GLU {
    
    public function __construct($data = NULL){
        if( $data !== NULL ){
            if( is_scalar( $data ) ) $data = array('htpasswd'=>$data );
            parent::__construct($data);
        }
        if( ! isset( $this->realm ) ) $this->realm = 'Restricted area';
        if( ! isset( $this->domain ) ) $this->domain = '/';
    }
    
    public function authenticate( $digest = NULL,  $request_method = NULL ){
        if( $digest === NULL ) $digest = isset( $_SERVER['PHP_AUTH_DIGEST'] ) ? $_SERVER['PHP_AUTH_DIGEST'] : '';
        if( $request_method === NULL ) $request_method = isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : '';
        if(! preg_match('/username="([^"]+)"/', $digest, $username) || 
           ! preg_match('/nonce="([^"]+)"/', $digest, $nonce) ||
           ! preg_match('/response="([^"]+)"/', $digest, $response) ||
           ! preg_match('/opaque="([^"]+)"/', $digest, $opaque) ||
           ! preg_match('/uri="([^"]+)"/', $digest, $uri )
           ) return FALSE;
        $username = $username[1];
        $nonce = $nonce[1];
        $response = $response[1];
        $opaque = $opaque[1];
        $uri = $uri[1];
        $htpasswd = new GLU(array('realm'=>$this->realm));
        if( $this->htpasswd ) $htpasswd->dispatch( $this->htpasswd );
        if( ! isset( $htpasswd->$username  ) ) return FALSE;
        $password = $htpasswd->$username;
        $A1 = ! $this->isMd5( $password ) ? $this->hashPassword( $username, $password ) : $password;
        $A2 = md5($request_method.':'.$uri);
        
        if(  preg_match('/qop="?([^,\s"]+)/', $digest, $qop) &&  
             preg_match('/nc=([^,\s"]+)/', $digest, $nc) &&  
             preg_match('/cnonce="([^"]+)"/', $digest, $cnonce) 
            ) { 
            $valid_response = md5($A1.':'.$nonce.':'.$nc[1].':'.$cnonce[1].':'.$qop[1].':'.$A2); 
         } else { 
            $valid_response = md5($A1.':'.$nonce.':'.$A2); 
        } 
        if( $response != $valid_response ) return FALSE;
        return $username;
    }
    
    public function challenge(){
        $headers = array();
        $headers[] = ('HTTP/1.1 401 Unauthorized');
        $headers[] = ('WWW-Authenticate: Digest realm="'.$this->realm.
                      '",qop="auth",algorithm=MD5,domain="' . $this->domain . 
                      '",nonce="'.uniqid() .
                      '",opaque="'.md5($this->realm).'"');
        return $headers;
    }
    
    public function hashPassword( $username, $password ){
        return md5( $username . ':' . $this->realm . ':' . $password );
    }
    
    protected function isMD5( $txt ){
        return preg_match('#^[a-f0-9]{32}$#', $txt);
    }
}