<?

// run the query.
$rs = $this->dispatch('query/plants');

// initialize the list of plant names
$plants = array();

// pull down all the plant names.
while( $row = $rs->fetch() ) $plants[] = $row['plant_name'];

// come up with a suitable page title
$title = 'SQLITE Test';

// build the message
$message = 'This is a list of plants: ' . implode(', ', $plants);

// render the header
$this->dispatch('layout/header', array('title'=>$title));

// render the message
$this->dispatch('layout/message', array('header'=>$title, 'body'=> $message) );

// render the footer
$this->dispatch('layout/footer');

// EOF