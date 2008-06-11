<?

$this->instance( array('title'=>'Introduction') )->dispatch('layout/header.php');

// pull down the data
$data = $this->instance( $this->data );


// build the body of the page
$this->instance( array('header'=>$data->title, 'body'=>$data->message) )->dispatch('layout/message.php'); 

// render the footer
$this->instance(array('start'=>$this->start))->dispatch('layout/footer.php'); 