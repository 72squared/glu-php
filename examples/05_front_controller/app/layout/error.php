<?
//find the current dir
$cwd = dirname(__FILE__);

$this->instance(array('title'=>'Error'))->dispatch($cwd . '/header.php');
$this->instance(array('header'=>'An error occurred', 'body'=>$this->exception ))->dispatch($cwd . '/message.php');
$this->instance(array('start'=>$this->start))->dispatch($cwd . '/footer.php');
