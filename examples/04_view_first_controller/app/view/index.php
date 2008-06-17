<?
// Build the site index page.
// right here you would call other actions or models to retrieve the information you need.
// then you build the page.
// In a view-first controller, you go to a view and then the view calls the actions needed to
// build the page. Since we already have all the info needed to build the page, just render it!


// render the header
self::dispatch(dir::layout . 'header.php', array('title'=>'Home')); 

// display a message 
self::dispatch(dir::layout . 'message.php', array('header'=>'Home Page', 'body'=>'This is a demo of how Grok can work'));

// render the footer
self::dispatch(dir::layout . 'footer.php', array('start'=>$input->start ) );

// EOF
