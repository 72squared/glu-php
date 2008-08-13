<?php
$start = microtime(TRUE);
$sep = DIRECTORY_SEPARATOR;
$dir = dirname(__FILE__) . $sep;
include $dir . 'class' . $sep . '__autoload.php';
$grok = Grok::instance(array('SCRIPT_START_TIME'=>$start));

try {
    $pattern = $dir . 'modules' . $sep . 'enabled' .$sep . '*.php';
    $files = glob($pattern);
    if( ! is_array( $files ) ) throw $this->Exception('invalid-config');
    if( count( $files ) < 1 ) {
        $grok->dispatch( $dir . 'modules' . $sep . 'initialize');
        print "\n<h1>INITIALIZING</h1>";
    } else {
        foreach( glob($pattern) as $file) {
            $grok->dispatch( $file );
        }
    }
} catch( Exception $e ){
    print $e;
}
//EOF