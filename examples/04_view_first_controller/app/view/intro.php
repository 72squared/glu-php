<?
// call the intro action so that we can build our page.
// pass along the input we got from the demo page so those vars can be
// used in the action.
$data = $this->dispatch('/model/intro', $input );

// render the header
$this->dispatch('layout/header', array('title'=>'Introduction') );

// build the body of the page
$this->dispatch('layout/message', array('header'=>$data->title, 'body'=>$data->message) ); 

// render the footer
$this->dispatch('layout/footer'); 

// EOF
