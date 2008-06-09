<?
$this->dispatch('/layout/header', array('title'=>'Error') );
$this->dispatch('/layout/message', array('header'=>'An error occurred', 'body'=>$input->exception ) );
$this->dispatch('/layout/footer');
