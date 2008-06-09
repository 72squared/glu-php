<?

$this->dispatch('/layout/header', array('title'=>'Introduction') );

// build the body of the page
$this->dispatch('/layout/message', array('header'=>$input->title, 'body'=>$input->message) ); 

// render the footer
$this->dispatch('/layout/footer'); 