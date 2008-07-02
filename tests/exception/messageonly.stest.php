<?php
//find the current dir
$cwd = dirname(__FILE__);include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Exception_MessageOnly_Test extends Grok_Exception_Test {

    public function setup() {
        $this->message = 'test message';
        parent::setup();
    }
    
    public function test_ExceptionMessageMatches(){
        return $this->assertEqual( $this->result->getMessage(), $this->message );
    }
    
    public function test_ExceptionCodeIsZero(){
        return $this->assertIdentical( $this->result->getCode(), 0 );
    }
    
    public function test_resultIsGrokException(){
        return $this->assertIsA( $this->result, 'Grok_Exception');
    }
}

// EOF