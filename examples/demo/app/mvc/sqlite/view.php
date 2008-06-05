<?
// come up with a suitable page title
$title = 'SQLITE Test';

// build the message
$message = 'This is a list of plants: ' . implode(', ', $input->plants );

// render the header
$this->dispatch('layout/header', array('title'=>$title));

// render the message
$this->dispatch('layout/message', array('header'=>$title, 'body'=> $message) );

// render the footer
$this->dispatch('layout/footer');