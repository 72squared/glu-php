<?php
$this->dispatch( $this->dir->ACTION . 'error');
$this->dispatch($this->dir->VIEW . 'site/header');
$this->dispatch($this->dir->VIEW . 'site/message');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF