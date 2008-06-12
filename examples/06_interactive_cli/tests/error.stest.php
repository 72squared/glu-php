<?
chdir( dirname(__FILE__)  );
include '../grok.php';

class Grok_InteractiveCLI_Error_Test extends Snap_UnitTestCase {
    
    protected $output;
    
    public function setup() {
        ob_start();
        Grok::instance(array('exception'=>'exception_string'))->dispatch('../app/error.php' );
        $this->output = ob_get_clean();
    }
    
    public function tearDown() {
        unset( $this->output );
    }
    
    public function test_OutputSays_Error(){
        return $this->assertRegex( $this->output, '/error/i');
    }
    
    public function test_OutputSays_ExceptionString(){
        return $this->assertRegex( $this->output, '/exception_string/i');
    }
}

// EOF