<?
// include grok.
include dirname( dirname( dirname(__FILE__) ) ) . DIRECTORY_SEPARATOR . 'grok.php';

// set the current working directory.
chdir( dirname(__FILE__)  );

/**
* Base class for testing the import method of Grok.
*/
class Grok_Import_Test extends Snap_UnitTestCase {
   
   /**
    * The grok object that we are testing
    * @type Grok
    */
    protected $grok;
    
   /**
    * the return value of Grok::import called in setup
    * @type mixed
    */
    protected $result_import;
    
    
   /**
    * the return value of the export method called in dispatch.
    * @type mixed
    */
    protected $result_export;
    
    
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
            $this->grok = Grok::instance();
            $this->result_import = $this->grok->import( $this->arg );
            $this->result_export = $this->grok->export();
        } catch( Exception $e ){
            $this->exception = $e;
            $this->exception_message = $e->getMessage();
        }
    }
    
    public function tearDown() {
        unset( $this->grok );
        unset( $this->arg);
        unset( $this->result_import );
        unset( $this->result_export );
        unset( $this->exception );
        unset( $this->exception_message );
    }
}

// EOF