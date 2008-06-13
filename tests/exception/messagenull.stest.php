<?
//find the current dir
$cwd = dirname(__FILE__);include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Exception_MessageNull_Test extends Grok_Exception_Test {
    
    public function test_ExceptionMessageSaysNothing(){
        return $this->assertEqual( $this->result->getMessage(), '' );
    }
    
    public function test_ExceptionCodeMatchesArg(){
        return $this->assertIdentical( $this->result->getCode(), intval($this->code) );
    }
    
    public function test_resultIsGrokException(){
        return $this->assertIsA( $this->result, 'Grok_Exception');
    }
}

// EOF