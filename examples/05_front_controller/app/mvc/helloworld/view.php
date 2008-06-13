<?
// find the current dir.
$cwd = dirname(__FILE__);

// we know what we want the title to be.
$title = 'Hello, World!';

// render the header and pass our page title to the header layout
$this->instance(array('title'=>$title))->dispatch($cwd . '/layout/header.php');

$data = $this->instance( $this->data );

// render our main content of the page, 
// giving it a header and the greeting that came from our action.
$this->instance(array('header'=>$title, 'body'=>$data->greeting))->dispatch($cwd . '/layout/message.php');

// build the action url
$action = $this->instance(array('route'=>'helloworld'))->dispatch($cwd . '/util/selfurl.php');


// render the form only if the model says we didn't get a name
if( ! $this->name_posted )
$this->instance(array('action'=>$action, 'method'=>'post'))->dispatch($cwd . '/layout/hello_form.php');

// render the page footer.
$this->instance(array('start'=>$this->start))->dispatch($cwd . '/layout/footer.php'); 

// EOF