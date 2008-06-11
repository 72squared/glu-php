<?
chdir( dirname(__FILE__)  );
include '../grok.php';

class Grok_SimpleDispatch_Hello_Test extends Snap_UnitTestCase {

    protected $result;
    protected $exception;
    protected $exception_message;
    public function setup() {
        try {
            $o = new test_grokker(array('greeting'=>'welcome'));
            $this->output = $o->dispatch('../lib/hello.php' );
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

class test_grokker extends grok {

}

// EOF
