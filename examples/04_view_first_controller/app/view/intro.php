<?
// call the intro action so that we can build our page.
// pass along the input we got from the demo page so those vars can be
// used in the action.
$data = self::dispatch( dir::model. 'intro.php', $input->request);

// render the header
self::dispatch(dir::layout . 'header.php', array('title'=>'Introduction'));

// build the body of the page
self::dispatch(dir::layout . 'message.php', array('header'=>$data->title, 'body'=>$data->message));

// render the footer
self::dispatch(dir::layout . 'footer.php', array('start'=>$input->start));

// EOF
