<?
//find the current dir
$cwd = dirname(__FILE__);include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Instance_Grok_Test extends Grok_Instance_Test {

    public function setup() {
        $grok = Grok::instance();
        $grok->test = 'test string';
        $this->arg = $grok;
        parent::setup();
    }
    
    public function test_ExportReturnsArg(){
        return $this->assertEqual( $this->result, $this->arg->export() );
    }
    
    public function test_GrokDataExportedIntoNew(){
        return $this->assertEqual( $this->result['test'], $this->arg->test );
    }
}

// EOF