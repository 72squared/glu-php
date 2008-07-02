<?php
// we know what we want the title to be.
$title = 'Ajax Demo';

// render the header and pass our page title to the header layout
$this->instance(array('title'=>$title) )->dispatch(dir::layout . 'header.php');

$this->instance(array('id'=>'mydiv', 'header'=>$title, 'body'=>'this text will be replaced'))->dispatch(dir::layout . 'message.php');

// build the link.
$link = $this->instance(array('route'=>'ajaxdemo', 'response'=>'1', 'dummy'=>'data'))->dispatch( dir::util . 'selfurl.php');

$this->instance(array('id'=>'mylink', 'href'=>$link, 'title'=>'test now', 'body'=>'run test'))->dispatch(dir::layout . 'link.php');

// include YUI libraries.
$this->instance()->dispatch(dir::layout . 'js/link/yui.php');

// include my own ajax caller script
$this->instance()->dispatch(dir::layout . 'js/link/callajax.php');

// render the page footer.
$this->instance(array('start'=>$this->start))->dispatch(dir::layout . 'footer.php'); 

// EOF