<?
//find the current dir
$cwd = dirname(__FILE__);
$this->instance( array('title'=>'Introduction') )->dispatch($cwd . '/layout/header.php');

// pull down the data
$data = $this->instance( $this->data );


// build the body of the page
$this->instance( array('header'=>$data->title, 'body'=>$data->message) )->dispatch($cwd . '/layout/message.php'); 

// render the footer
$this->instance(array('start'=>$this->start))->dispatch($cwd . '/layout/footer.php'); 