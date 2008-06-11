<? 

// let's call the helloworld model
$this->data = $this->instance($this->request)->dispatch('model.php');

// render the view
$this->dispatch('view.php');

// EOF