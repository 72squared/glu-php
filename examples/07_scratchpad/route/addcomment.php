<?php
$this->dispatch($this->DIR_ACTION . 'addcomment');
if( $this->comment->entry_id ) return $this->dispatch( $this->DIR_ROUTE . 'showcomments');

$this->title = $this->pad->title . ' - AddComment';
$this->dispatch($this->DIR_TPL . 'site/header');
$this->dispatch($this->DIR_TPL . 'scratchpad/breadcrumbs');
$this->dispatch($this->DIR_TPL . 'scratchpad/nav');
$this->dispatch($this->DIR_TPL . 'scratchpad/addcommentform');
$this->dispatch($this->DIR_TPL . 'site/footer');
// EOF