<?
//find the current dir
$cwd = dirname(__FILE__);//find the working dir
$updir = dirname(dirname(__FILE__));

return $this->dispatch($updir . '/level5/hello.php');

// EOF