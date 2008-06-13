<?
//find the current dir
$cwd = dirname(__FILE__);
// this is really just a passthru call to allow the css to be displayed
$this->dispatch($cwd . '/view.php');

// EOF