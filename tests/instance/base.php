<?php
// include grok.
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'grok.php';

/**
* Base class for testing the instance method of Grok.
*/
class Grok_Instance_Test extends Snap_UnitTestCase {
   
   /**
    * The grok object that we are testing
    * @type Grok
    */
    protected $grok;
    
   /**
    * the argument we pass to Grok::__construct
    * @type mixed
    */
    protected $arg = NULL;
    
   /**
    * the return value of the export method.
    * @type mixed
    */
    protected $result;
    
   /**
    * The base setup method.
    * Here, we instantiate a grok, then export before and after dispatch.
    *
    */
    public function setup() {
        $this->grok = Grok::instance($this->arg);
        $export = array();
        foreach( $this->grok as $k=>$v) $export[$k] = $v;
        $this->result = $export;
    }
    
    public function teardown() {
        unset( $this->arg );
        unset( $this->grok );
        unset( $this->result );
    }
}

// EOF