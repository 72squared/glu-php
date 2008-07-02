<?php
//find the current dir
$cwd = dirname(__FILE__);include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Instance_StdClass_Test extends Grok_Instance_Test {

    public function setup() {
        $obj = new stdclass;
        $obj->a = 'test';
        $obj->b = 'test';
        $obj->c = 'test';
        $this->arg = $obj;
        parent::setup();
    }
    
    public function test_ExportResultIsEmpty(){
        return $this->assertEqual( $this->result, array() );
    }
}

// EOF