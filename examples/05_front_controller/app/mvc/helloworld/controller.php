<?
// find the current dir
$cwd = dirname(__FILE__);

// let's call the helloworld model
$this->data = $this->instance($this->request)->dispatch($cwd . '/model.php');

// render the view
$this->dispatch($cwd . '/view.php');

// EOF