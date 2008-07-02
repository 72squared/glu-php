<?php
//find the current dir
$cwd = dirname(__FILE__);include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_Instance_Iterator_Test extends Grok_Instance_Test {

    public function setup() {
        $this->arg = new ArrayIterator(array('a', 'b', 'c'));
        parent::setup();
    }
    
    public function test_ExportResultEqualsArg(){
        return $this->assertEqual( $this->result, array('a', 'b', 'c') );
    }
}

// EOF