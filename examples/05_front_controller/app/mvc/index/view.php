<?
// render the header
$this->instance(array('title'=>'Home'))->dispatch('layout/header.php'); 

// display a message 
$this->instance(array('header'=>'Home Page', 'body'=>'This is a demo of how Grok can work'))->dispatch('layout/message.php');

// render the footer
$this->instance(array('start'=>$this->start))->dispatch('layout/footer.php');

// EOF