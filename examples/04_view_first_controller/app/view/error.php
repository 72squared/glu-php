<?php
$this->instance( array('title'=>'Error') )->dispatch(dir::layout . 'header.php');
$this->instance( array('header'=>'An error occurred', 'body'=>$this->exception ) )->dispatch(dir::layout . 'message.php');
$this->instance( array('start'=>$start) )->dispatch(dir::layout . 'footer.php');

// EOF