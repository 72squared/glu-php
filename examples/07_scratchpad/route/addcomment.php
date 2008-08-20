<?php
$this->dispatch($this->DIR_ROOT . 'action/addcomment');
if( $this->comment->entry_id ) return $this->dispatch( $this->DIR_APP . 'run/showcomments');

$this->title = $this->pad->title . ' - AddComment';
$this->dispatch($this->DIR_APP . 'tpl/header');
$this->dispatch($this->DIR_APP . 'tpl/breadcrumbs');
$this->dispatch($this->DIR_APP . 'tpl/nav');
$this->dispatch($this->DIR_APP . 'tpl/addcommentform');
$this->dispatch($this->DIR_APP . 'tpl/footer');
// EOF