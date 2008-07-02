<?php
// include the grok
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'grok.php';

class Grok_InteractiveCLI_Quit_Test extends Snap_UnitTestCase {
    
    protected $output;
    protected $response;
    
    public function setup() {
        ob_start();
        $this->response = Grok::instance()->dispatch(dirname(dirname(__FILE__)) . '/app/action/quit.php' );
        $this->output = ob_get_clean();
    }
    
    public function tearDown() {
        unset( $this->output );
        unset( $this->response );
    }
    
    public function test_OutputSays_GoodBye(){
        return $this->assertRegex( $this->output, '/good bye/i');
    }
    
    public function test_ResponseIsFalse(){
        return $this->assertIdentical( $this->response, FALSE);
    }
}

// EOF
