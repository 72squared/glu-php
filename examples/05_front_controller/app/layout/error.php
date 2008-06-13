<?
$this->instance(array('title'=>'Error'))->dispatch(dir::layout . 'header.php');
$this->instance(array('header'=>'An error occurred', 'body'=>$this->exception ))->dispatch(dir::layout . 'message.php');
$this->instance(array('start'=>$this->start))->dispatch(dir::layout . 'footer.php');
