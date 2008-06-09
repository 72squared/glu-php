<? 

// let's call the helloworld model
$data = $this->dispatch('/mvc/helloworld/model', $input );

// render the view
return $this->dispatch('/mvc/helloworld/view', $data );

// EOF