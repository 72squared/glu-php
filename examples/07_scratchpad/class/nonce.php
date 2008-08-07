<?php 
/**
* use a number once
*/

class Nonce {
  
   /**
    * @tupe string
    */
    protected static $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    
    
    public function __construct( $secret ){
        $this->secret = strval($secret);
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
        $digest = md5($rand . $this->secret . $ts );
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
        if( md5( $rand . $this->secret . $ts ) != $digest ) return FALSE;
        return TRUE;
    }
    
    protected function now(){
        return time();
    }

}