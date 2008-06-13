<?
// render the header
$this->instance( array('title'=>'Introduction') )->dispatch(dir::layout . 'header.php');

// pull down the data
$data = $this->instance( $this->data );


// build the body of the page
$this->instance( array('header'=>$data->title, 'body'=>$data->message) )->dispatch(dir::layout . 'message.php'); 

// render the footer
$this->instance(array('start'=>$this->start))->dispatch(dir::layout . 'footer.php'); 