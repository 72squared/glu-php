<?
// call the intro action so that we can build our page.
// pass along the input we got from the demo page so those vars can be
// used in the action.
$data = $this->instance($this->request)->dispatch( dir::model. 'intro.php');

// render the header
$this->instance(array('title'=>'Introduction'))->dispatch(dir::layout . 'header.php');

// build the body of the page
$this->instance( array('header'=>$data->title, 'body'=>$data->message))->dispatch(dir::layout . 'message.php'); 

// render the footer
$this->instance(array('start'=>$this->start))->dispatch(dir::layout . 'footer.php'); 

// EOF
