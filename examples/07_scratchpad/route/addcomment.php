<?php
$this->dispatch($this->DIR_ACTION . 'addcomment');
if( $this->comment->entry_id ) return $this->dispatch( $this->DIR_ROUTE . 'showcomments');
$this->dispatch($this->DIR_VIEW . 'addcomment');
// EOF