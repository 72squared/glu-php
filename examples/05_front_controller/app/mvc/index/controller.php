<?
//find the current dir
$cwd = dirname(__FILE__);// skip calling any models. 
// just show the view.
return $this->dispatch($cwd . '/view.php');

// EOF
