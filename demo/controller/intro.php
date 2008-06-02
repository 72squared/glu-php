<?

$input->import( $this->dispatch('action/intro', $input ) );
$this->dispatch('layout/header', array('title'=>'Introduction') );
$this->dispatch('layout/message', array('header'=>$input->title, 'body'=>$input->message) ); 
$this->dispatch('layout/footer'); 

// EOF
