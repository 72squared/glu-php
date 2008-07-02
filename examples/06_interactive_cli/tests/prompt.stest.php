<?php
// include the grok
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'grok.php';

class Grok_InteractiveCLI_Prompt_Test extends Snap_UnitTestCase {
    
    protected $output;
    
    public function setup() {
        ob_start();
        Grok::instance()->dispatch(dirname(dirname(__FILE__)) . '/app/prompt.php' );
        $this->output = ob_get_clean();
    }
    
    public function tearDown() {
        unset( $this->output );
    }
    
    public function test_OutputSays_GT(){
        return $this->assertRegex( $this->output, '/>/');
    }
}

// EOF
