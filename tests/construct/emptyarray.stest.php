<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Construct_EmptyArray_Test extends Grok_Construct_Base_Test {
    
    public function setup(){
        $this->arg = array();
        parent::setup();
    }
    
    public function test_ExportIsEmptyBeforeDispatch(){
        return $this->assertIdentical( $this->result_export_before_dispatch, array());
    }
    
    public function test_ExportIsEmptyAfterDispatch(){
        return $this->assertIdentical( $this->result_export_after_dispatch, array());
    }
    
    public function test_DispatchRunsString(){
       return $this->assertEqual( $this->result_dispatch, 'hello' );
    }
    
    public function test_NoExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

//EOF