<?php

class Link_Extractor extends Grok {
    
    
    
    
    public function __construct( $data = NULL ){
    
        if( $data instanceof iterator ) {
            $str = '';
            foreach($data as $v ) $str .= ' ' . $v;
            $data = $str;
        }
        if( is_array( $data ) ) $data = implode(' ', $data );
        if( ! preg_match_all("#\[[\w]+\]:[\s](((https?|ftp|gopher|telnet|file|notes|ms-help):((//)|(\\\\)))?+[\w\d:\#@%/;$()~_?\+-=\\\.&]*)#", $data, $matches ) ) return;
        if( ! isset( $matches[1] ) ) return;
        foreach( $matches[1] as $url){
            if( strlen( $url ) > 0 ) $this->push($url);
        }
    }

}