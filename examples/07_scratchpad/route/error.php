<?php
$this->dispatch( $this->DIR_ROOT . 'action/error');
$this->dispatch($this->DIR_APP . 'tpl/header');
$this->dispatch($this->DIR_APP . 'tpl/message');
$this->dispatch($this->DIR_APP . 'tpl/footer'); 
// EOF