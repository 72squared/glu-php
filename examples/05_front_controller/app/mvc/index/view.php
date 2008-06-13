<?
//find the current dir
$cwd = dirname(__FILE__);// render the header
$this->instance(array('title'=>'Home'))->dispatch($cwd . '/layout/header.php'); 

// display a message 
$this->instance(array('header'=>'Home Page', 'body'=>'This is a demo of how Grok can work'))->dispatch($cwd . '/layout/message.php');

// render the footer
$this->instance(array('start'=>$this->start))->dispatch($cwd . '/layout/footer.php');

// EOF