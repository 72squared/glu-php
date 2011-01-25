<?php
// define the autoload function.
function glu_class_autoloader($c) {
    include dirname(__FILE__). DIRECTORY_SEPARATOR . strtolower($c) . '.php';
}

// register the autoload function.
spl_autoload_register("glu_class_autoloader");

// EOF
