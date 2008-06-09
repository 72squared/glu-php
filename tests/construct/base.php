<?
// include grok.
include dirname( dirname( dirname(__FILE__) ) ) . DIRECTORY_SEPARATOR . 'grok.php';

// set the current working directory.
chdir( dirname(__FILE__)  );

/**
* Base class for testing the constructor method of Grok.
* We can only tell what happens inside the constructor by looking at
* the outcome of the dispatch method call and by the export method.
* For that reason, we control what gets passed to the dispatch method,
* and then vary the different types of strings passed to the constructor.
*/
class Grok_Construct_Test extends Snap_UnitTestCase {
   
   /**
    * The grok object that we are testing
    * @type Grok
    */
    protected $grok;
    
   /**
    * the return value of Grok::dispatch called in setup
    * @type mixed
    */
    protected $result_dispatch;
    
   /**
    * the return value of the export method called before dispatch.
    * @type mixed
    */
    protected $result_export_before_dispatch;
    
    
   /**
    * the return value of the export method called after dispatch.
    * @type mixed
    */
    protected $result_export_after_dispatch;
    
    
   /**
    * the argument we pass to Grok::__construct
    * @type mixed
    */
    protected $arg = NULL;
    
    
   /**
    * if an exception gets thrown in the setup, it is attached here.
    * @type Exception / null
    */
    protected $exception;
    
   /**
    * the message of the exception, if one is thrown in setup.
    * @type string / null
    */
    protected $exception_message;
    
   /**
    * The base setup method.
    * Here, we instantiate a grok, then export before and after dispatch.
    *
    */
    public function setup() {
        try {
            $this->grok = Grok::instance( $this->arg );
            $this->result_export_before_dispatch = $this->grok->export();
            $this->result_dispatch = $this->grok->dispatch('/lib/string');
            $this->result_export_after_dispatch = $this->grok->export();
        } catch( Exception $e ){
            $this->exception = $e;
            $this->exception_message = $e->getMessage();
        }
    }
    
    public function tearDown() {
        unset( $this->grok );
        unset( $this->result_dispatch );
        unset( $this->arg);
        unset( $this->result_export_before_dispatch );
        unset( $this->result_export_after_dispatch );
        unset( $this->exception );
        unset( $this->exception_message );
    }
}

// EOF