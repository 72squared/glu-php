<?

$this->instance( array('title'=>'Error') )->dispatch('layout/header.php');
$this->instance( array('header'=>'An error occurred', 'body'=>$this->exception ) )->dispatch('layout/message.php');
$this->instance( array('start'=>$start) )->dispatch('layout/footer.php');

// EOF