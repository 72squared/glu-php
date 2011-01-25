<?php
$this->instance( 
    array(  'title'=>'Error',
            'message'=>array('header'=>'An error occurred', 'body'=>$this->exception ),
            'start'=>$this->start,
        ) )->dispatch(dir::layout . 'site.php');

// EOF