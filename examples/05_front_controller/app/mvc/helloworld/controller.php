<? 

// let's call the helloworld model
$data = $this->dispatch('model', $input );

// render the view
return $this->dispatch('view', $data );

// EOF