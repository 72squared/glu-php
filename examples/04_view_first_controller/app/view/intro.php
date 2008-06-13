<?
//find the current dir
$cwd = dirname(__FILE__);

// call the intro action so that we can build our page.
// pass along the input we got from the demo page so those vars can be
// used in the action.
$data = $this->instance($this->request)->dispatch(dirname( $cwd ) . '/model/intro.php');

// render the header
$this->instance(array('title'=>'Introduction'))->dispatch($cwd . '/layout/header.php');

// build the body of the page
$this->instance( array('header'=>$data->title, 'body'=>$data->message))->dispatch($cwd . '/layout/message.php'); 

// render the footer
$this->instance(array('start'=>$this->start))->dispatch($cwd . '/layout/footer.php'); 

// EOF
