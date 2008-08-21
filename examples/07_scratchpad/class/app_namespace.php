<?php
class App_Namespace extends Grok {

    protected function __set( $k, $v ){
        switch( $k ){
            case 'pad'      :   if( ! $v instanceof Scratchpad ) return NULL;
                                break;
            
            case 'request'  :   if( ! $v instanceof Grok ) return NULL;
                                break;
            
            case 'server'   :   if( ! $v instanceof Grok ) return NULL;
                                break;
            
            case 'session'  :   if( ! $v instanceof Session ) return NULL;
                                break;
            
            case 'user'     :   if( ! $v instanceof User ) return NULL;
                                break;
                                
            case 'NEW'      :   if( ! $v instanceof Instantiator ) return NULL;
                                break;
                                
            case 'headers'  :   if( ! $v instanceof Grok ) return NULL;
                                break;
                                
            case 'dir'      :   if( ! $v instanceof Grok ) return NULL;
                                break;
            
            case 'path'     :   $v = '/' . trim( preg_replace( '/[^a-z0-9\/\_\-\.]/', '', strval( $v ) ), ' /');
                                break;
            
            case 'route'    :   $v = preg_replace( '/[^a-z0-9_\-]/', '', strval( $v ) );
                                break;
            
            case 'baseurl'  :   $v = preg_replace( '/[^a-z0-9\/\_\-\.]/', '', strval( $v ) );
                                break;
            
        }
        return parent::__set($k, $v);
    }
}

// EOC