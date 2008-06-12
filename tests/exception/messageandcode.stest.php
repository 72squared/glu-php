<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Exception_MessageAndCode_Test extends Grok_Exception_Test {

    public function setup() {
        $this->message = 'test message';
        $this->code = '2';
        parent::setup();
    }
    
    public function test_ExceptionMessageMatches(){
        return $this->assertEqual( $this->result->getMessage(), $this->message );
    }
    
    public function test_ExceptionCodeMatchesArg(){
        return $this->assertIdentical( $this->result->getCode(), intval($this->code) );
    }
    
    public function test_resultIsGrokException(){
        return $this->assertIsA( $this->result, 'Grok_Exception');
    }
}

// EOF