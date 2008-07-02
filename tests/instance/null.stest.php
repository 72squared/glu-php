<?php
//find the current dir
$cwd = dirname(__FILE__);include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Instance_Null_Test extends Grok_Instance_Test {

    public function setup() {
        $this->arg = NULL;
        parent::setup();
    }
    
    public function test_ExportResultEmpty(){
        return $this->assertIdentical( $this->result, array() );
    }
}

// EOF