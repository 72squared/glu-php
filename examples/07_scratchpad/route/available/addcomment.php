<?php
$this->dispatch($this->dir->ACTION . 'addcomment');
if( $this->comment->entry_id ) return $this->dispatch( $this->dir->ROUTE . 'comments');
$this->title = $this->pad->title . ' - Add Comment';
$this->dispatch($this->dir->VIEW . 'site/header');
$this->dispatch($this->dir->VIEW . 'scratchpad/addcommentform');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF