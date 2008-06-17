<?
// include the grok
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'grok.php';

class Grok_InteractiveCLI_Hello_Test extends Snap_UnitTestCase {
    
    protected $output;
    
    public function setup() {
        ob_start();
        Grok::dispatch(dirname(dirname(__FILE__)) . '/app/action/hello.php' );
        $this->output = ob_get_clean();
    }
    
    public function tearDown() {
        unset( $this->output );
    }
    
    public function test_OutputSays_HelloWorld(){
        return $this->assertRegex( $this->output, '/hello, world/i');
    }
}

// EOF
