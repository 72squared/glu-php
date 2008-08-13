<?php
$this->dispatch( $this->DIR_ACTION . 'error');
$this->dispatch($this->DIR_APP . 'tpl/header');
$this->dispatch($this->DIR_APP . 'tpl/message');
$this->dispatch($this->DIR_APP . 'tpl/footer'); 
// EOF