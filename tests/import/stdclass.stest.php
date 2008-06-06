<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Import_StdClass_Test extends Grok_Import_Test {

    public function setup() {
        $obj = new stdclass;
        $obj->a = 'test';
        $obj->b = 'test';
        $obj->c = 'test';
        $this->arg = $obj;
        parent::setup();
    }
    
    public function test_ImportResultEqualsArg(){
        return $this->assertEqual( $this->result_import, $this->arg );
    }
    
    public function test_ExportResultIsEmpty(){
        return $this->assertEqual( $this->result_export, array() );
    }
    
    public function test_NoExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF