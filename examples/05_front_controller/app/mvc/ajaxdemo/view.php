<? 
// we know what we want the title to be.
$title = 'Ajax Demo';

// render the header and pass our page title to the header layout
$this->instance(array('title'=>$title) )->dispatch('layout/header.php');

$this->instance(array('id'=>'mydiv', 'header'=>$title, 'body'=>'this text will be replaced'))->dispatch('layout/message.php');

// build the link.
$link = $this->instance(array('route'=>'ajaxdemo', 'response'=>'1', 'dummy'=>'data'))->dispatch('util/selfurl.php');

$this->instance(array('id'=>'mylink', 'href'=>$link, 'title'=>'test now', 'body'=>'run test'))->dispatch('layout/link.php');

// include YUI libraries.
$this->instance()->dispatch('layout/js/link/yui.php');

// include my own ajax caller script
$this->instance()->dispatch('layout/js/link/callajax.php');

// render the page footer.
$this->instance(array('start'=>$this->start))->dispatch('layout/footer.php'); 

// EOF