<?

$this->dispatch('layout/header', array('title'=>'Home') ); 
$this->dispatch('layout/message', array('header'=>'Home Page', 'body'=>'This is a demo of how Grok can work') );
$this->dispatch('layout/footer');

// EOF
