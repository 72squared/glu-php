<?
// we know what we want the title to be.
$title = 'Ajax Demo';

// render the header and pass our page title to the header layout
self::dispatch(dir::layout . 'header.php', array('title'=>$title));

self::dispatch(dir::layout . 'message.php', array('id'=>'mydiv', 'header'=>$title, 'body'=>'this text will be replaced'));

// build the link.
$link = self::dispatch( dir::util . 'selfurl.php', array('route'=>'ajaxdemo', 'response'=>'1', 'dummy'=>'data'));

self::dispatch(dir::layout . 'link.php', array('id'=>'mylink', 'href'=>$link, 'title'=>'test now', 'body'=>'run test'));

// include YUI libraries.
self::dispatch(dir::layout . 'js/link/yui.php');

// include my own ajax caller script
self::dispatch(dir::layout . 'js/link/callajax.php');

// render the page footer.
self::dispatch(dir::layout . 'footer.php', array('start'=>$input->start)); 

// EOF