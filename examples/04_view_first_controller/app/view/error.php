<?
//find the current dir
$cwd = dirname(__FILE__);
$this->instance( array('title'=>'Error') )->dispatch($cwd . '/layout/header.php');
$this->instance( array('header'=>'An error occurred', 'body'=>$this->exception ) )->dispatch($cwd . '/layout/message.php');
$this->instance( array('start'=>$start) )->dispatch($cwd . '/layout/footer.php');

// EOF