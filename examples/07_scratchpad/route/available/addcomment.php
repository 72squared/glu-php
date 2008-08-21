<?php
$this->dispatch($this->dir->ACTION . 'addcomment');
if( $this->comment->entry_id ) return $this->dispatch( $this->dir->ROUTE . 'showcomments');
$this->dispatch($this->dir->VIEW . 'addcomment');
// EOF