<?php
$start = microtime(TRUE);
$sep = DIRECTORY_SEPARATOR;
$dir = dirname(__FILE__) . $sep;
include $dir . 'class' . $sep . '__autoload.php';
$grok = Grok::instance(array('SCRIPT_START_TIME'=>$start));
$grok->NEW = new Instantiator;
try {
    $pattern = $dir . 'modules' . $sep . 'enabled' .$sep . '*.php';
    $files = glob($pattern);
    if( ! is_array( $files ) ) throw $this->NEW->Exception('invalid-config');
    if( count( $files ) < 1 ) {
        $grok->dispatch( $dir . 'modules' . $sep . 'initialize');
        $files = glob($pattern);
        if( ! is_array( $files ) || count( $files ) < 1 ) {
            throw $this->NEW->Exception('fail-initialize-modules');
        }
    }
    foreach( $files as $file ) {
       if( $grok->dispatch( $file ) === FALSE ) break;
    }
    
} catch( Exception $e ){
    print $e;
}
//EOF