<? 

$data = new Grok( $this->dispatch('action/helloworld', $input ) );
$this->dispatch('layout/header', array('title'=>'Hello World') );
$this->dispatch('layout/message', array('header'=>'Hello World', 'body'=>$data->greeting) );
$this->dispatch('layout/footer'); 

// EOF