<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Import_Array_Test extends Grok_Import_Test {

    public function setup() {
        $this->arg = array('0'=>'a', 'test'=>'test', '0a'=>'fun', '000'=>'fun', 'valid1'=>'1', 'a'=>'string', 'under_score'=>'test', 'dash-it'=>'test');
        parent::setup();
    }

    public function test_ImportResultEqualsArg(){
        return $this->assertEqual( $this->result_import, $this->arg );
    }
    
    public function test_ExportResultEqualsArg(){
        return $this->assertEqual( $this->result_export, $this->arg );
    }
    
    public function test_NoExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF