<?php 
/**
* use a number once
*/

class Nonce {
  
   /**
    * @tupe string
    */
    protected static $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    
    protected $key = '';
    
    
    public function __construct( $key ){
        $this->key = strval($key);
    }
    
    
   /**
    * create a secure nonce
    * @param string     key
    * @param int        timestamp
    * @return string
    */
    public function create( $ts = NULL ){
        if( ! $ts ) $ts = $this->now();
        $rand = '';
        $len = strlen( self::$charset ) - 1;
        for ($i=0; $i<32; $i++) $rand .= self::$charset[(mt_rand(0,$len))];  
        $nonce = md5( $rand . $ts );
        $digest = md5($rand . $this->key . $this->secret() . $ts );
        return $nonce . $digest . $rand . $ts;
    }
    
   /**
    * validate a nonce
    * @param string     nonce string
    * @param string     key
    * @param int        timestamp (optional)
    * @return boolean
    */
    public function validate( $hash, $now = NULL ){
        if( strlen( $hash ) < 97 ) return FALSE;
        $nonce = substr($hash, 0, 32);
        $digest = substr($hash, 32, 32);
        $rand = substr($hash, 64, 32);
        $ts = substr($hash, 96);
        if( ! is_numeric( $ts ) ) return false;
        if( ! $now ) $now = $this->now();
        if( abs( $ts - $now ) > 3600 ) return FALSE;
        if( md5( $rand . $ts ) != $nonce ) return FALSE;
        if( md5( $rand . $this->key . $this->secret() . $ts ) != $digest ) return FALSE;
        return TRUE;
    }
    
    protected function now(){
        return time();
    }
    
    protected function secret(){
        return 
            "AAAAB3NzaC1kc3MAAACBAPM3u52T7LYT+qBIuV7cDxyDTXasa2NxJxdfBxLcnIXwhPtdAahrBA8g+XxBrwLe9".
            "ObceUD1pvDY2vkj/X9QaWMMRfseM/V9CvcXiOTXB4uYxe8oXkNOcYGuwZHF8RuIhHUm1kMmwD0AAFj1FjWPdw".
            "Gb2UAx27QOy6WP9I0S6mtqrC5JVHihAAAAFQDH4Ch+31XSD3CW/b/nDliZRiaXbwAAAIEAqWUmifQ8NJ3Yb9f".
            "G0zPmE22cnBm3XKgM91DNT2eeG3XFePcqqpIP5RuLu8CKjx372HVmUuGKvpqtnCwc8DpG0rqhUB60amf/0BHb".
            "wFS8BRadLv2lpIJt2aC2W6v9q2LJckG/4Jey19JtNx3p/1+DDGLDKwEWn/O6OCeNyTK58eAAAACBAN4yQFqeu".
            "Ecge2WEGGvDdLRYR94sBtzcZzQbgjbI2NY/YW63Xt4xGm/8Cj0XFla3THZez4j38PD7fG2it1jMspNlIMfA9w".
            "Jo2SSLKRSPQYxbmva3IGidYfLSoNpQ93PFed+WJe0ljfVxJk19jQ3z89S4uqwlANp0QxvlU+19kgdUbHfsscR".
            "EwWEotrosRJKLPEVBNDFSZaweTFYKBYJz12aasdfS2a1qa+7asdfAFHYRASdsvdsdeDAWasSssASDRFHKJ450";
    }

}