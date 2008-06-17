<?
// we know what we want the title to be.
$title = 'Hello, World!';

// render the header and pass our page title to the header layout
self::dispatch(dir::layout . 'header.php', array('title'=>$title) );

$data = self::instance( $input->data );

// render our main content of the page, 
// giving it a header and the greeting that came from our action.
self::dispatch(dir::layout . 'message.php', array('header'=>$title, 'body'=>$data->greeting));

// build the action url
$action = self::dispatch(dir::util . 'selfurl.php', array('route'=>'helloworld'));

// render the form only if the model says we didn't get a name
if( ! $data->name_posted )
    self::dispatch(dir::layout . 'hello_form.php', array('action'=>$action, 'method'=>'post'));

// render the page footer.
self::dispatch(dir::layout . 'footer.php', array('start'=>$input->start)); 

// EOF