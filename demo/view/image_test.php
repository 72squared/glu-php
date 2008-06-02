<? 
$title = 'Image Test';
$src = $this->dispatch('format/selfurl', array('view'=>'image', 'path'=>'test.gif') );
$this->dispatch('layout/header', array('title'=>$title) );
$this->dispatch('layout/message', array('header'=>$title, 'body'=>'check out this image') );
$this->dispatch('layout/img', array('src'=>$src ) );
$this->dispatch('layout/footer'); 

// EOF