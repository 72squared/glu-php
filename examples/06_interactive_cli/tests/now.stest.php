<?
// include the grok
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'grok.php';

class Grok_InteractiveCLI_Now_Test extends Snap_UnitTestCase {
    
    protected $output;
    protected $args;
    public function setup() {
        ob_start();
        Grok::instance($this->args)->dispatch(dirname(dirname(__FILE__)) . '/app/action/now.php' );
        $this->output = ob_get_clean();
    }
    
    public function tearDown() {
        unset( $this->output );
        unset( $this->args );
    }
}

class Grok_InteractiveCLI_Now_NoArgs_Test extends Grok_InteractiveCLI_Now_Test {
    
    public function test_OutputSays_TimeIs(){
        return $this->assertRegex( $this->output, '/The time is/i');
    }
    
    public function test_OutputSays_GMT(){
        return $this->assertRegex( $this->output, '/GMT/i');
    }

}


class Grok_InteractiveCLI_Now_GMT_Test extends Grok_InteractiveCLI_Now_Test {
    
    public function setup(){
        $this->args = array('now'=>'1213286964', 'timezone'=>'GMT', 'format'=>'Y/m/d H:i:s e');
        parent::setup();
    }
    
    public function test_OutputSays_TimeIs(){
        return $this->assertRegex( $this->output, '/The time is/i');
    }
    
    public function test_OutputSays_TimestampFormattedGMT(){
        return $this->assertRegex( $this->output, '#2008/06/12 16:09:24 GMT#i');
    }
}

class Grok_InteractiveCLI_Now_UTC_Test extends Grok_InteractiveCLI_Now_Test {
    
    public function setup(){
        $this->args = array('now'=>'1213286963', 'timezone'=>'UTC', 'format'=>'Y/m/d H:i:s e');
        parent::setup();
    }
    
    public function test_OutputSays_TimeIs(){
        return $this->assertRegex( $this->output, '/The time is/i');
    }
    
    public function test_OutputSays_TimestampFormattedUTC(){
        return $this->assertRegex( $this->output, '#2008/06/12 16:09:23 UTC#i');
    }
}

// EOF
