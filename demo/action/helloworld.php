<?

// we are gonna set up a new grok with some default data.
$data = new Grok( array('name'=>'Stranger') );

// now we are gonna layer over the current input
$data->import( $input );

// now we run the greeting model with a new source of input.
return $this->dispatch('model/greeting', $data );

// EOF