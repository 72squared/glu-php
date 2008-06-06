<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Import_Iterator_Test extends Grok_Import_Test {

    public function setup() {
        $this->arg = new ArrayIterator(array('a', 'b', 'c'));
        parent::setup();
    }
    
    public function test_ImportResultEqualsArg(){
        return $this->assertEqual( $this->result_import, $this->arg );
    }
    
    public function test_ExportResultEqualsArg(){
        return $this->assertEqual( $this->result_export, array('a', 'b', 'c') );
    }
    
    public function test_NoExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF