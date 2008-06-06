<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Import_Grok_Test extends Grok_Import_Test {

    public function setup() {
        $grok = new Grok;
        $grok->test = 'test string';
        $this->arg = $grok;
        parent::setup();
    }
    
    public function test_ImportReturnsArg(){
        return $this->assertEqual( $this->result_import, $this->arg );
    }
    
    public function test_GrokDataExportedIntoNew(){
        return $this->assertEqual( $this->result_export['test'], $this->arg->test );
    }
    
    
    public function test_NoExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF