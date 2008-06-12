<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Instance_String_Test extends Grok_Instance_Test {

    public function setup() {
        $this->arg = 'test string';
        parent::setup();
    }
    
    public function test_ExportResultIsNull(){
        return $this->assertIdentical( $this->result, array() );
    }
}

// EOF