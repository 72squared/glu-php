<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Dispatch_PathUnsanitized_Test extends Grok_Dispatch_Test {

    public function setup() {
        $this->path = '$ # @ & */ hello ^ ( )';
        parent::setup();
    }
    
    public function test_returnFromDispatch(){
        return $this->assertIdentical( $this->result_dispatch, 'hi there' );
    }
    
    public function test_exportBeforeIsEmpty(){
        return $this->assertEqual( $this->result_export_before_dispatch, array() );
    }


    public function test_exportAfterIsEmpty(){
        return $this->assertEqual( $this->result_export_after_dispatch, array() );
    }
    
    public function test_NoExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF