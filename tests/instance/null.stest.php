<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Instance_Null_Test extends Grok_Instance_Test {

    public function setup() {
        $this->arg = NULL;
        parent::setup();
    }
    
    public function test_ExportResultIsNull(){
        return $this->assertIdentical( $this->export, array() );
    }
}

// EOF