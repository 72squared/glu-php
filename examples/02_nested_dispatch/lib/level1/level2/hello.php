<?php
//find the current dir
$cwd = dirname(__FILE__);//find the current working dir
$cwd = dirname(__FILE__);

return $this->dispatch($cwd . '/level3/hello.php');

// EOF