<?
//find the current dir
$cwd = dirname(__FILE__);include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Instance_Array_Test extends Grok_Instance_Test {

    public function setup() {
        $this->arg = array('0'=>'a', 'test'=>'test', '0a'=>'fun', '000'=>'fun', 'valid1'=>'1', 'a'=>'string', 'under_score'=>'test', 'dash-it'=>'test');
        parent::setup();
    }
    
    public function test_ExportResultEqualsArg(){
        return $this->assertEqual( $this->result, $this->arg );
    }
}

// EOF