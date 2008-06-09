<? 
// we know what we want the title to be.
$title = 'Ajax Demo';

// render the header and pass our page title to the header layout
$this->dispatch('/layout/header', array('title'=>$title) );

$this->dispatch('/layout/message', array('id'=>'mydiv', 'header'=>$title, 'body'=>'this text will be replaced') );

// build the link.
$link = $this->dispatch('/util/selfurl', array('route'=>'ajaxdemo', 'response'=>'1', 'dummy'=>'data'));

$this->dispatch('/layout/link', array('id'=>'mylink', 'href'=>$link, 'title'=>'test now', 'body'=>'run test') );

// include YUI libraries.
$this->dispatch('/layout/js/link/yui');

// include my own ajax caller script
$this->dispatch('/layout/js/link/callajax');

// render the page footer.
$this->dispatch('/layout/footer'); 

// EOF