<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Import_String_Test extends Grok_Import_Test {

    public function setup() {
        $this->arg = 'test string';
        parent::setup();
    }
    
    public function test_ImportResultIsString(){
        return $this->assertTrue( is_string( $this->result_import ) );
    }
    
    public function test_ImportResultEqualsArg(){
        return $this->assertEqual( $this->result_import, $this->arg );
    }
    
    public function test_ExportResultIsNull(){
        return $this->assertIdentical( $this->result_export, array() );
    }
    
    public function test_NoExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF