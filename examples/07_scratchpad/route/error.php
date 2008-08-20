<?php
$this->dispatch( $this->DIR_ACTION . 'error');
$this->dispatch($this->DIR_TPL . 'header');
$this->dispatch($this->DIR_TPL . 'message');
$this->dispatch($this->DIR_TPL . 'footer'); 
// EOF