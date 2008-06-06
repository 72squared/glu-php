<?
// render the header
$this->dispatch('layout/header', array('title'=>'Home') ); 

// display a message 
$this->dispatch('layout/message', array('header'=>'Home Page', 'body'=>'This is a demo of how Grok can work') );

// render the footer
$this->dispatch('layout/footer');

// EOF