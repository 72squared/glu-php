<?
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'base.php';

class Grok_ClassVars_Objects_Test extends Grok_ClassVars_Test {

    public function setup() {
        $this->input = array('a'=>Grok::instance(), 'b'=>new stdclass, 'c'=> new ArrayIterator( array(1,2,3) ) );
        parent::setup();
    }
    
    public function test_Set(){
        return $this->assertEqual( $this->input, $this->result_set );
    }
    
    public function test_Get(){
        return $this->assertEqual( $this->input, $this->result_get );
    }
    
    public function test_Isset(){
        $input = array();
        foreach( array_keys( $this->input ) as $k) $input[ $k ] = TRUE;
        return $this->assertEqual( $input, $this->result_isset );
    }
    
    public function test_Unset(){
        $input = array();
        foreach( array_keys( $this->input ) as $k) $input[ $k ] = NULL;
        return $this->assertEqual( $input, $this->result_unset );
    }
    
    public function test_NonExistent(){
        return $this->assertNull( $this->grok->non_existent );
    }
}

// EOF