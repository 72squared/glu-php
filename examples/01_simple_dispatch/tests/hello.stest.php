<?
// include the grok
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'grok.php';

class Grok_SimpleDispatch_Hello_Test extends Snap_UnitTestCase {

    protected $result;
    protected $exception;
    protected $exception_message;
    public function setup() {
        try {
            $this->output = Grok::dispatch( dirname(dirname(__FILE__)) . '/lib/hello.php', array('greeting'=>'welcome') );
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
        return $this->assertRegex( $this->output, '/from grok/i');
    }
    
    public function test_noExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF
