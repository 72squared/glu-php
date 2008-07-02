<?php

$root = dirname( dirname(__FILE__) ) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR;
define('CLASS_DIR_APP', $root );
define('CLASS_DIR_LAYOUT', $root . 'layout' . DIRECTORY_SEPARATOR);
define('CLASS_DIR_MVC', $root . 'mvc' . DIRECTORY_SEPARATOR);
define('CLASS_DIR_UTIL', $root . 'util' . DIRECTORY_SEPARATOR);

class Dir {
    const app = CLASS_DIR_APP;
    const layout = CLASS_DIR_LAYOUT;
    const mvc = CLASS_DIR_MVC;
    const util = CLASS_DIR_UTIL;
}