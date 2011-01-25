<?php
$this->dispatch($this->dir->ACTION . 'descendents');
$this->title = 'Sub-Topics for ' . $this->pad->title;
$this->dispatch($this->dir->VIEW . 'site/header');
$this->dispatch($this->dir->VIEW . 'scratchpad/list');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF