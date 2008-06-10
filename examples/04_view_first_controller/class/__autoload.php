<?
// define the autoload function.
function grok_class_autoloader($c) {
    $file = dirname(__FILE__). DIRECTORY_SEPARATOR . $c . '.php';
    if(! file_exists($file) ) return FALSE;
    include($file);
}

// register the autoload function.
spl_autoload_register("grok_class_autoloader");

// EOF
