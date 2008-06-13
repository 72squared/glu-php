<?
// find the current dir.
$cwd = dirname(__FILE__);

// let's call the helloworld action to get some data so we can build our page.
$data = $this->instance($this->request)->dispatch(dirname($cwd ) . '/model/helloworld.php');

// we know what we want the title to be.
$title = 'Hello, World!';

// render the header and pass our page title to the header layout
$this->instance(array('title'=>$title))->dispatch($cwd . '/layout/header.php');


// render our main content of the page, 
// giving it a header and the greeting that came from our action.
$this->instance( array('header'=>$title, 'body'=>$data->greeting))->dispatch($cwd . '/layout/message.php');

// render the form only if the model says we didn't get a name
if( ! $data->name_posted )
$this->instance( array('action'=>'helloworld', 'method'=>'post') )->dispatch($cwd . '/layout/hello_form.php');

// render the page footer.
$this->instance(array('start'=>$this->start))->dispatch($cwd . '/layout/footer.php'); 

// EOF