<?
chdir( dirname(__FILE__)  );
include '../grok.php';

class Grok_InteractiveCLI_Help_Test extends Snap_UnitTestCase {
    
    protected $output;
    
    public function setup() {
        ob_start();
        Grok::instance()->dispatch('../app/action/help.php' );
        $this->output = ob_get_clean();
    }
    
    public function tearDown() {
        unset( $this->output );
    }
    
    public function test_OutputSays_TypeCommand(){
        return $this->assertRegex( $this->output, '/type a command/i');
    }
    
    public function test_OutputSays_Help(){
        return $this->assertRegex( $this->output, '/help/i');
    }
    
    public function test_OutputSays_Hello(){
        return $this->assertRegex( $this->output, '/hello/i');
    }
    
    public function test_OutputSays_Now(){
        return $this->assertRegex( $this->output, '/now/i');
    }
    
    public function test_OutputSays_Quit(){
        return $this->assertRegex( $this->output, '/quit/i');
    }
}

// EOF
