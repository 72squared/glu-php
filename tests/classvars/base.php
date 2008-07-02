<?php

// include grok.
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'grok.php';

/**
* Base class for testing the import method of Grok.
*/
class Grok_ClassVars_Test extends Snap_UnitTestCase {
   
   /**
    * The grok object that we are testing
    * @type Grok
    */
    protected $grok;
    
   /**
    * the return value of Grok::import called in setup
    * @type mixed
    */
    protected $input = array();
    
   /**
    * a keyed array of the outcome of all the input set operations
    * @type mixed
    */
    protected $result_set = array();
    
   /**
    * a keyed array of the outcome of all the input get operations
    * @type mixed
    */
    protected $result_get = array();
    
   /**
    * a keyed array of the outcome of all the input isset operations
    * @type mixed
    */
    protected $result_isset = array();
    
   /**
    * a keyed array of the outcome of all the input get operations after the key has been unset.
    * @type mixed
    */
    protected $result_unset = array();
    
    
    
   /**
    * the argument we pass to Grok::__construct
    * @type mixed
    */
    protected $arg = NULL;
    
   /**
    * The base setup method.
    * Here, we instantiate a grok, then export before and after dispatch.
    *
    */
    public function setup() {
        $this->grok = Grok::instance();
        foreach( array('result_set', 'result_get', 'result_isset', 'result_unset') as $key ){
            $this->$key = array();
        }
        if( ! is_array( $this->input ) ) $this->input = array();
        foreach( $this->input as $k=>$v ){
            $this->result_set[ $k ] = $this->grok->$k = $v;
            $this->result_isset[ $k ] = isset( $this->grok->$k );
            $this->result_get[ $k ] = $this->grok->$k;
            unset( $this->grok->$k );
            $this->result_unset[ $k ] = $this->grok->$k;
        }
    }
    
   /**
    *Do some cleanup.
    */
    public function tearDown() {
        foreach( array('grok', 'input', 'result_set', 'result_get', 'result_isset', 'result_unset') as $key ){
            unset( $this->$key );
        }
    }
}

// EOF