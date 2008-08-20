<?php
$this->dispatch($this->DIR_ACTION . 'addcomment');
if( $this->comment->entry_id ) return $this->dispatch( $this->DIR_ROUTE . 'showcomments');

$this->title = $this->pad->title . ' - AddComment';
$this->dispatch($this->DIR_TPL . 'header');
$this->dispatch($this->DIR_TPL . 'breadcrumbs');
$this->dispatch($this->DIR_TPL . 'nav');
$this->dispatch($this->DIR_TPL . 'addcommentform');
$this->dispatch($this->DIR_TPL . 'footer');
// EOF