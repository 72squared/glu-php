<?php
// define the autoload function.
function glu_class_autoloader($c) {
    $file = dirname(__FILE__). DIRECTORY_SEPARATOR . strtolower($c) . '.php';
    if(! file_exists($file) ) return FALSE;
    include($file);
}

// register the autoload function.
spl_autoload_register("glu_class_autoloader");

// EOF
