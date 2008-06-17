<?
// render the header
self::dispatch(dir::layout . 'header.php', array('title'=>'Home')); 

// display a message 
self::dispatch(dir::layout . 'message.php', array('header'=>'Home Page', 'body'=>'This is a demo of how Grok can work'));

// render the footer
self::dispatch(dir::layout . 'footer.php', array('start'=>$input->start));

// EOF