<?php
// render the header
$this->instance(array('title'=>'Home'))->dispatch(dir::layout . 'header.php'); 

// display a message 
$this->instance(array('header'=>'Home Page', 'body'=>'This is a demo of how GLU can work'))->dispatch(dir::layout . 'message.php');

// render the footer
$this->instance(array('start'=>$this->start))->dispatch(dir::layout . 'footer.php');

// EOF