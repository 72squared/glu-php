<?php

class Scratchpad_Authors extends User_Lister {
    
    public function __construct( Scratchpad_Lister $pads ){
        $authors = array();
        foreach($pads as $pad ){
            if( ! $pad->author ) continue;
            $authors[ $pad->author ] = 1;
        }
        parent::__construct( array_keys($authors) );
    }
}