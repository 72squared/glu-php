<?php
$this->dispatch($this->dir->ACTION . 'changes');
$this->title = 'changes for ' . $this->pad->title;
$this->dispatch($this->dir->VIEW . 'site/header');
$this->dispatch($this->dir->VIEW . 'scratchpad/list');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF