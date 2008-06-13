<?
//find the current dir
$cwd = dirname(__FILE__);$this->data = $this->instance($this->request)->dispatch($cwd . '/model.php');
return $this->dispatch($cwd . '/view.php');

// EOF
