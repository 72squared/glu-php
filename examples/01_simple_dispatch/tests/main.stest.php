<?
// set the current working directory.
chdir( dirname(__FILE__)  );

// include grok.
include '../grok.php';

/**
* Base class for testing the import method of Grok.
*/
class Grok_SimpleDispatch_Main_Test extends Snap_UnitTestCase {
    
   /**
    * the return value of Grok::import called in setup
    * @type mixed
    */
    protected $result;
    
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
            ob_start();
            Grok::instance()->dispatch('../lib/main');
            $this->output = ob_get_contents();
            ob_end_clean();
        } catch( Exception $e ){
            $this->exception = $e;
            $this->exception_message = $e->getMessage();
        }
    }
    
    public function tearDown() {
        unset( $this->output );
        unset( $this->exception );
        unset( $this->exception_message );
    }
    
    public function test_OutputSaysHello(){
        return $this->assertRegex( $this->output, '/hello/i');
    }
    
    public function test_OutputSaysFromGrok(){
        return $this->assertRegex( $this->output, '/from grok/i');
    }
    
    public function test_noExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF