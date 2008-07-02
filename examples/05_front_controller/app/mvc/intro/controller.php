<?php
$cwd = dirname(__FILE__) . DIRECTORY_SEPARATOR;
$this->data = $this->instance($this->request)->dispatch($cwd . 'model.php');
return $this->dispatch($cwd .'view.php');

// EOF
