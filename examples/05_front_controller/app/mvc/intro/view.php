<?
// render the header
self::dispatch(dir::layout . 'header.php', array('title'=>'Introduction'));

// pull down the data
$data = self::instance( $input->data );

// build the body of the page
self::dispatch(dir::layout . 'message.php', array('header'=>$data->title, 'body'=>$data->message) ); 

// render the footer
self::dispatch(dir::layout . 'footer.php', array('start'=>$input->start)); 