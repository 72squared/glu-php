<?php
$this->dispatch( $this->DIR_ACTION . 'error');
$this->dispatch($this->DIR_TPL . 'site/header');
$this->dispatch($this->DIR_TPL . 'site/message');
$this->dispatch($this->DIR_TPL . 'site/footer'); 
// EOF