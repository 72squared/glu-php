<?php

class Persistent extends Grok {
    
    private $checksum;
    
    protected function load(){
        $this->storage()->load( $this );
        $this->checksum = $this->checksum();
    }
    
    public function store(){
        $v = $this->storage()->store( $this );
        $this->checksum = $this->checksum();
        return $v;
    }
    
    public function destroy(){
        return $this->storage()->destroy($this);
    }
    
    public function checkAndStore(){
        if( $this->checksum == $this->checksum() ) return;
        $this->store();
    }
    
    protected function storage(){
    
    }
    
    protected function checksum(){
        $data = array();
        foreach($this as $k=>$v) $data[$k] = $v;
        return md5(serialize($data));
    }
}

// EOF 