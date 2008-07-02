<?php

$root = dirname( dirname(__FILE__) ) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR;
define('CLASS_DIR_APP', $root );
define('CLASS_DIR_LIB', $root . 'lib' . DIRECTORY_SEPARATOR);
define('CLASS_DIR_MODEL', $root . 'model' . DIRECTORY_SEPARATOR);
define('CLASS_DIR_VIEW', $root . 'view' . DIRECTORY_SEPARATOR);
define('CLASS_DIR_LAYOUT', CLASS_DIR_VIEW . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR);

class Dir {
    const app = CLASS_DIR_APP;
    const lib = CLASS_DIR_LIB;
    const model = CLASS_DIR_MODEL;
    const view = CLASS_DIR_VIEW;
    const layout =CLASS_DIR_LAYOUT;
}