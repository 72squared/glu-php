<?
// Build the site index page.
// right here you would call other actions or models to retrieve the information you need.
// then you build the page.
// In a view-first controller, you go to a view and then the view calls the actions needed to
// build the page. Since we already have all the info needed to build the page, just render it!


// render the header
$this->instance( array('title'=>'Home') )->dispatch(dir::layout . 'header.php'); 

// display a message 
$this->instance( array('header'=>'Home Page', 'body'=>'This is a demo of how Grok can work'))->dispatch(dir::layout . 'message.php');

// render the footer
$this->instance( array('start'=>$this->start ) )->dispatch(dir::layout . 'footer.php');

// EOF
