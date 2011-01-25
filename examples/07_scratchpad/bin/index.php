<?php
$start = microtime(TRUE);
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . '__autoload.php';
$controller = new ScratchpadController(array('START_TIME'=>$start));
$controller->run();
//EOF