<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Construct_IncorrectPath_Test extends Grok_Construct_Test {

    public function setup() {
        $this->arg = 'nowhere';
        parent::setup();
    }
    public function test_ExportIsEmptyBeforeDispatch(){
        return $this->assertIdentical( $this->result_export_before_dispatch, array());
    }

    public function test_ExportNotCalledAfterDispatch(){
        return $this->assertNull($this->result_export_after_dispatch);
    }
    
    public function test_ExceptionWasThrown(){
        return $this->assertIsA($this->exception, 'exception');
    }
    
    public function test_ExceptionMessageMatchesInvalid(){
        return $this->assertRegex( $this->exception_message, '/invalid/');
    }
    
    public function test_ExceptionMessageMatchesDispatch(){
        return $this->assertRegex( $this->exception_message, '/dispatch/');
    }
    
    public function test_ExceptionMessageMatchesNowhere(){
        return $this->assertRegex( $this->exception_message, '/string/');
    }
}

// EOF