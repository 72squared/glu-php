<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Import_Null_Test extends Grok_Import_Test {

    public function setup() {
        $this->arg = NULL;
        parent::setup();
    }
    
    public function test_ImportResultIsNull(){
        return $this->assertNull( $this->result_import );
    }
    
    public function test_ExportResultIsNull(){
        return $this->assertIdentical( $this->result_export, array() );
    }
    
    public function test_NoExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF