<?php
// let's call the helloworld action to get some data so we can build our page.
$data = $this->instance($this->request)->dispatch(dir::model . 'helloworld.php');

// we know what we want the title to be.
$title = 'Hello, World!';

// assemble the content
$content = array();
if( ! $data->name_posted ) $content[dir::layout . 'hello_form.php'] = array('action'=>'helloworld', 'method'=>'post');

// render the page
$this->instance( 
    array(  'title'=>$title,
            'message'=>array('header'=>$title, 'body'=>$data->greeting),
            'content'=>$content,
            'start'=>$this->start,
        ) )->dispatch(dir::layout . 'site.php'); 

// EOF