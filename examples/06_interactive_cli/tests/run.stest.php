<?
// include the grok
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'grok.php';

class Grok_InteractiveCLI_Run_Test extends Snap_UnitTestCase {
    
    protected $line;
    protected $output;
    protected $response;
    
    public function setup() {
        ob_start();
        $this->response = Grok::instance(array('line'=>$this->line))->dispatch(dirname(dirname(__FILE__)) . '/app/run.php' );
        $this->output = ob_get_clean();
    }
    
    public function tearDown() {
        unset( $this->output );
        unset( $this->response );
        unset( $this->line );
    }
}

class Grok_InteractiveCLI_Run_NoLine_Test extends Grok_InteractiveCLI_Run_Test {
    
    public function test_OutputIsPrompt(){
        return $this->assertEqual(trim($this->output), ">");
    }
    
    public function test_responseIsTrue(){
        return $this->assertIdentical( $this->response, TRUE);
    }
}

class Grok_InteractiveCLI_Run_Hello_Test extends Grok_InteractiveCLI_Run_Test {
    
    public function setup(){
        $this->line = 'hello';
        parent::setup();
    }
    
    public function test_OutputHasPrompt(){
        return $this->assertTRUE( strpos($this->output, '>') !== FALSE);
    }
    
    public function test_OutputHasHello(){
        return $this->assertRegex($this->output, "/hello/i");
    }
    
    
    public function test_responseIsTrue(){
        return $this->assertIdentical( $this->response, TRUE);
    }
}

class Grok_InteractiveCLI_Run_help_Test extends Grok_InteractiveCLI_Run_Test {
    
    public function setup(){
        $this->line = 'help';
        parent::setup();
    }
    
    public function test_OutputHasPrompt(){
        return $this->assertTRUE( strpos($this->output, '>') !== FALSE);
    }
    
    public function test_OutputHasHelp(){
        return $this->assertRegex($this->output, "/help/i");
    }
    
    public function test_OutputHasTypeCommand(){
        return $this->assertRegex($this->output, "/type a command/i");
    }
    
    public function test_responseIsTrue(){
        return $this->assertIdentical( $this->response, TRUE);
    }
}

class Grok_InteractiveCLI_Run_now_Test extends Grok_InteractiveCLI_Run_Test {
    
    public function setup(){
        $this->line = 'now';
        parent::setup();
    }
    
    public function test_OutputHasPrompt(){
        return $this->assertTRUE( strpos($this->output, '>') !== FALSE);
    }
    
    public function test_OutputHasTimeIS(){
        return $this->assertRegex($this->output, "/The time is/i");
    }
    
    public function test_responseIsTrue(){
        return $this->assertIdentical( $this->response, TRUE);
    }
}

class Grok_InteractiveCLI_Run_Quit_Test extends Grok_InteractiveCLI_Run_Test {
    
    public function setup(){
        $this->line = 'quit';
        parent::setup();
    }
    
    public function test_OutputHasNoPrompt(){
        return $this->assertFalse( strpos($this->output, '>'));
    }
    
    public function test_OutputHasTimeIS(){
        return $this->assertRegex($this->output, "/good bye/i");
    }
    
    public function test_responseIsFalse(){
        return $this->assertIdentical( $this->response, FALSE);
    }
}

// EOF
