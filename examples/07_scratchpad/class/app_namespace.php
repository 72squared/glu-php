<?php
class App_Namespace extends Grok {

    public function __construct( $data = NULL ){
        parent::__construct( $data );
        $this->NEW = new Instantiator;
        $this->request = new Grok( $_REQUEST );
        $this->server = new Grok( $_SERVER );
        $path = str_replace( $this->baseurl, '', $this->server->REQUEST_URI);
        if( ( $pos = strpos( $path, '?' ) ) !==FALSE) $path = substr( $path, 0, $pos );
        $this->path = $path;
        foreach( $_FILES as $k=>$v ) $this->request->$k = $v;
        $this->dir = new Dir;
        $this->route = (  $this->request->route ) ? $this->request->route :'display';
        if( substr($this->path,-5) != '.text' ) return;
        $this->path = substr($this->path, 0, -5);
        if( $this->path == '/index' ) $this->path = '/';
        $this->route = 'text';
    }

    protected function __set( $k, $v ){
        switch( $k ){
            case 'pad'          : if( ! $v instanceof Scratchpad ) return NULL;
                                break;
                                
            case 'comment'      : if( ! $v instanceof Scratchpad ) return NULL;
                                break;
            
            case 'request' :    if( ! $v instanceof Grok ) return NULL;
                                break;
            
            case 'server' :     if( ! $v instanceof Grok ) return NULL;
                                break;
            
            case 'session' :    if( ! $v instanceof Session ) return NULL;
                                break;
            
            case 'user' :       if( ! $v instanceof User ) return NULL;
                                break;
            
            case 'author' :     if( ! $v instanceof User ) return NULL;
                                break;
                                
            case 'permission' : if( ! $v instanceof Permission ) return NULL;
                                break;
                                
            case 'NEW' :        if( ! $v instanceof Instantiator ) return NULL;
                                break;
                                
            case 'headers' :    if( ! $v instanceof Grok ) return NULL;
                                break;
                                
            case 'dir' :        if( ! $v instanceof Dir ) return NULL;
                                break;
                                
            case 'list' :       if( ! $v instanceof Grok ) return NULL;
                                break;
                                
            case 'path' :       $v = '/' . trim( preg_replace( '/[^a-z0-9\/\_\-\.]/', '', strval( $v ) ), ' /');
                                break;
            
            case 'route' :      $v = preg_replace( '/[^a-z0-9_\-]/', '', strval( $v ) );
                                break;
            
            case 'baseurl' :    $v = preg_replace( '/[^a-z0-9\/\_\-\.]/i', '', strval( $v ) );
                                break;
                                
            case 'title' :      $v = preg_replace( '/[^a-z0-9_\-\. ]/i', '', strval( $v ) );
                                break;
                                
            case 'START_TIME' : if( ! is_numeric( $v ) ) return NULL;
                                break;
            
            //default:        print '<pre>' . $k . '</pre>';
        }
        return parent::__set($k, $v);
    }
}

// EOC