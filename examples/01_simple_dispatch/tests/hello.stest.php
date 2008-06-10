<?
// set the current working directory.
chdir( dirname(__FILE__)  );

// include grok.
include '../grok.php';

/**
* Base class for testing the import method of Grok.
*/
class Grok_SimpleDispatch_Hello_Test extends Snap_UnitTestCase {
    
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
            $input = array('greeting'=>'welcome');
            $o = new test_grokker();
            $this->output = $o->dispatch('../lib/hello', $input );
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
        return $this->assertRegex( $this->output, '/welcome/i');
    }
    
    public function test_OutputSaysFromGrok(){
        return $this->assertRegex( $this->output, '/from test_grokker/i');
    }
    
    public function test_noExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// junk class to prove that if i extend the grok class, it all still works.
class test_grokker extends grok {

}

// EOF