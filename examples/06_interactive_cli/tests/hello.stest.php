<?
chdir( dirname(__FILE__)  );
include '../grok.php';

class Grok_InteractiveCLI_Hello_Test extends Snap_UnitTestCase {
    
    protected $output;
    
    public function setup() {
        ob_start();
        Grok::instance()->dispatch('../app/action/hello.php' );
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
