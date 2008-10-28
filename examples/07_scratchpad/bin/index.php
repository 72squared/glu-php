<?php
$start = microtime(TRUE);
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . '__autoload.php';
$app = new App_Namespace(array('START_TIME'=>$start));
$app->run();
//EOF