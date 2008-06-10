<? 

// let's call the helloworld action to get some data so we can build our page.
$data = $this->instance( $this->dispatch('/model/helloworld', $input ) );

// we know what we want the title to be.
$title = 'Hello, World!';

// render the header and pass our page title to the header layout
$this->dispatch('layout/header', array('title'=>$title) );

// we can decide to filter our message before rendering it
$message = $this->dispatch('/lib/sanitize', array('header'=>$title, 'body'=>$data->greeting) );

// render our main content of the page, 
// giving it a header and the greeting that came from our action.
$this->dispatch('layout/message', $message );

// render the form only if the model says we didn't get a name
if( ! $data->name_posted )
$this->dispatch('layout/hello_form', array('action'=>'helloworld', 'method'=>'post') );

// render the page footer.
$this->dispatch('layout/footer'); 

// EOF