<?
chdir( dirname(__FILE__)  );
include '../grok.php';

class Grok_SimpleDispatch_Main_Test extends Snap_UnitTestCase {
    protected $result;
    protected $exception;
    protected $exception_message;
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
