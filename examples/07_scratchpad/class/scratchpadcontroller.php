<?php
class ScratchpadController extends GLU {

    public function __construct( $data = NULL ){
        parent::__construct( $data );
        $this->NEW = new Instantiator;
        if( get_magic_quotes_gpc() ){
            foreach( $_REQUEST as $k=>$v){
                if( is_scalar( $v ) ) $_REQUEST[ $k ] = stripslashes($v);
            }
            foreach( $_FILES as $k=>$v){
                if( is_scalar( $v ) ) $_FILES[ $k ] = stripslashes($v);
            }
            foreach( $_SERVER as $k=>$v){
                if( is_scalar( $v ) ) $_FILES[ $k ] = stripslashes($v);
            }
        }
        $this->request = new GLU( $_REQUEST );
        foreach( $_FILES as $k=>$v ) $this->request->$k = $v;
        
        $this->server = new GLU( $_SERVER );
        $this->selfurl = rtrim( substr( $this->server->SCRIPT_FILENAME, 
                 strlen($this->server->DOCUMENT_ROOT)), ' /');
        
        $this->baseurl = rtrim( substr( dirname($this->server->SCRIPT_FILENAME) . '/', 
                 strlen($this->server->DOCUMENT_ROOT)), ' /');
        
        $path = str_replace( $this->selfurl, '', $this->server->REQUEST_URI);
        if( ( $pos = strpos( $path, '?' ) ) !==FALSE) $path = substr( $path, 0, $pos );
        $this->path = $path;        

        
        $this->dir = new Dir;
        
        
        $this->route = (  $this->request->route ) ? $this->request->route :'display';
        if( substr($this->path,-5) != '.text' ) return;
        $this->path = substr($this->path, 0, -5);
        if( $this->path == '/index' ) $this->path = '/';
        $this->route = 'text';
    }
    
    public function run(){
        ob_start();
        try {
            $sep = DIRECTORY_SEPARATOR;
            $pattern = $this->dir->ROOT . 'module' . $sep . 'enabled' .$sep . '*.php';
            $files = glob($pattern);
            if( ! is_array( $files ) ) throw $this->NEW->Exception('invalid-config');
            foreach( $files as $file ) {
               if( $this->dispatch( $file ) === TRUE ) return;
            }
            ob_start();
        
            $this->dispatch( $this->dir->ROOT . 'route/initialize');
            
            try {
                $this->dispatch( $this->dir->ROOT . 'route/enabled/' . $this->route );
            } catch( Exception $e ){
                $this->exception = $e;
                $this->debug = ob_get_clean();
                ob_start();
                $this->dispatch($this->dir->ROOT . 'route/available/error');
            }
            
            if( $this->headers ){
                foreach( $this->headers as $k=>$v ) {
                    if( is_numeric( $k ) ) {
                        header($v);
                    } else {
                        header($k . ': ' . $v);
                    }
                }
                unset( $this->headers );
            }
            
            foreach( $this->keys() as $k ) unset( $this->$k );
            
            ob_end_flush();
            
        } catch( Exception $e ){
            print $e;
        }
        ob_end_flush();
    }

    public function __set( $k, $v ){
        switch( $k ){
            case 'pad'          : if( ! $v instanceof Scratchpad ) return NULL;
                                break;
                                
            case 'comment'      : if( ! $v instanceof Scratchpad ) return NULL;
                                break;
            
            case 'request' :    if( ! $v instanceof GLU ) return NULL;
                                break;
            
            case 'server' :     if( ! $v instanceof GLU ) return NULL;
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
                                
            case 'headers' :    if( ! $v instanceof GLU ) return NULL;
                                break;
                                
            case 'dir' :        if( ! $v instanceof Dir ) return NULL;
                                break;
                                
            case 'list' :       if( ! $v instanceof GLU ) return NULL;
                                break;
                                
            case 'path' :       $v = '/' . trim( preg_replace( '/[^a-z0-9\/\_\-\.]/', '', strval( $v ) ), ' /');
                                break;
            
            case 'route' :      $v = preg_replace( '/[^a-z0-9_\-]/', '', strval( $v ) );
                                break;
            
            case 'baseurl' :    $v = preg_replace( '/[^a-z0-9\/\_\-\.]/i', '', strval( $v ) );
                                break;
                                
            case 'selfurl' :    $v = preg_replace( '/[^a-z0-9\/\_\-\.]/i', '', strval( $v ) );
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