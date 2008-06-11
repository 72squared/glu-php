<?
$this->data = $this->instance($this->request)->dispatch('model.php');
return $this->dispatch('view.php');

// EOF
