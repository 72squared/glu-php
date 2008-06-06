<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Dispatch_Input_Test extends Grok_Dispatch_Test {

    public function setup() {
        $this->path = 'input';
        $this->input = new Grok( array('test'=>'fun') );
        parent::setup();
    }
    
    public function test_returnFromDispatchIsAGrok(){
        return $this->assertIsA( $this->result_dispatch, 'Grok');
    }
    
    public function test_returnFromDispatch_DifferentFromGrok(){
        return $this->assertNotEqual( $this->result_dispatch, $this->grok);
    }
    
    public function test_returnFromDispatch_IdenticalToInput(){
        return $this->assertIdentical( $this->result_dispatch, $this->input );
    }
    
    public function test_returnFromDispatch_ContainsInput(){
        return $this->assertEqual( $this->result_dispatch->export(), $this->input->export() );
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