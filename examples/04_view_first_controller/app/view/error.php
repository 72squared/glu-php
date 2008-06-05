<?

$this->dispatch('view/layout/header', array('title'=>'Error') );
$this->dispatch('view/layout/message', array('header'=>'An error occurred', 'body'=>$input->exception ) );
$this->dispatch('view/layout/footer');

// EOF