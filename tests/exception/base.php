<?
// include grok.
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'grok.php';

/**
* Base class for testing the exception method of Grok.
*/
class Grok_Exception_Test extends Snap_UnitTestCase {
   
   /**
    * the argument we pass to Grok::exception( $message );
    * @type mixed
    */
    protected $message = NULL;
    
   /**
    * the argument we pass to Grok::exception( $message, $code );
    * @type mixed
    */
    protected $code = NULL;
    
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
        $this->grok = Grok::instance();
         if( $this->message === NULL ){
            $this->result = Grok::instance()->exception();
        } elseif( $this->code === NULL ){
            $this->result = Grok::instance()->exception( $this->message );
        } else {
            $this->result = Grok::instance()->exception( $this->message, $this->code );
        }
    }
    
    public function teardown() {
        unset( $this->message );
        unset( $this->code );
        unset( $this->result );
    }
}

// EOF