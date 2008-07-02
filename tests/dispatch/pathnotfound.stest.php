<?php
//find the current dir
$cwd = dirname(__FILE__);include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Dispatch_PathNotFound_Test extends Grok_Dispatch_Test {

    public function setup() {
        $this->path = dirname(__FILE__) . '/lib/non_existent.php';
        parent::setup();
    }
    
    public function test_exportBeforeIsEmpty(){
        return $this->assertEqual( $this->result_export_before_dispatch, array() );
    }
    
    public function test_NoExportAfter(){
        return $this->assertNull( $this->result_export_after_dispatch );
    }
    
    public function test_NoReturnFromDispatch(){
        return $this->assertNull( $this->result_dispatch );
    }
    
    public function test_ExceptionThrown(){
        return $this->assertIsA( $this->exception, 'Exception' );
    }
    
    public function test_ExceptionMessageSaysInvalid(){
        return $this->assertRegex( $this->exception_message, '/invalid/');
    }
    
    public function test_ExceptionMessageSaysDispatch(){
        return $this->assertRegex( $this->exception_message, '/dispatch/');
    }
}

// EOF