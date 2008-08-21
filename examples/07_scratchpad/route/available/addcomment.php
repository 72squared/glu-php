<?php
$this->dispatch($this->dir->ACTION . 'addcomment');
if( $this->comment->entry_id ) return $this->dispatch( $this->dir->ROUTE . 'comments');
$this->dispatch($this->dir->VIEW . 'addcomment');
// EOF