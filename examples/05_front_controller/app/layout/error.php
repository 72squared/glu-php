<?
$this->instance(array('title'=>'Error'))->dispatch('header.php');
$this->instance(array('header'=>'An error occurred', 'body'=>$this->exception ))->dispatch('message.php');
$this->instance(array('start'=>$this->start))->dispatch('footer.php');
