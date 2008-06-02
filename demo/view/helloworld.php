<? 

// let's call the helloworld action to get some data so we can build our page.
$data = new Grok( $this->dispatch('action/helloworld', $input ) );

// we know what we want the title to be.
$title = 'Hello, World!';

// render the header and pass our page title to the header layout
$this->dispatch('layout/header', array('title'=>$title) );

// render our main content of the page, 
// giving it a header and the greeting that came from our action.
$this->dispatch('layout/message', array('header'=>$title, 'body'=>$data->greeting) );

// render the page footer.
$this->dispatch('layout/footer'); 

// EOF