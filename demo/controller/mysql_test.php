<?

// run the mysql test action
$data = new Grok( $this->dispatch('action/mysql_test') );

// come up with a suitable page title
$title = 'MySQL Database Test';

// use the data from the test to generate a message.
$message = 'The database time is: '. date('Y/m/d H:i:s', $data->time ) . 
           ' with a crc32 checksum of ' . $data->crc32; 
           
// render the header
$this->dispatch('layout/header', array('title'=>$title));

// render the message
$this->dispatch('layout/message', array('header'=>$title, 'body'=> $message) );

// render the footer
$this->dispatch('layout/footer');

// EOF