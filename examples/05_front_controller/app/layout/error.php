<?
self::dispatch(dir::layout . 'header.php', array('title'=>'Error'));
self::dispatch(dir::layout . 'message.php', array('header'=>'An error occurred', 'body'=>$input->exception ));
self::dispatch(dir::layout . 'footer.php', array('start'=>$input->start));

// EOF