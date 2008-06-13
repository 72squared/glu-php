<?
//find the current dir
$cwd = dirname(__FILE__);include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Construct_AssocArray_Test extends Grok_Construct_Test {
    
    public function setup(){
        $this->arg = array('test'=>'string', 'stdclass'=> new stdclass);
        parent::setup();
    }
    
    public function test_ExportMatchesArgBeforeDispatch(){
        return $this->assertIdentical( $this->result_export_before_dispatch, $this->arg);
    }
    
    public function test_ExportMatchesArgAfterDispatch(){
        return $this->assertIdentical( $this->result_export_after_dispatch, $this->arg);
    }
    
    public function test_DispatchRunsString(){
       return $this->assertEqual( $this->result_dispatch, 'hello' );
    }
    
    public function test_NoExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF