<?php
$this->dispatch($this->dir->ACTION . 'display');
$this->title = $this->pad->title;
$this->dispatch($this->dir->VIEW . 'site/header');
$this->dispatch($this->dir->VIEW . 'scratchpad/comments');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF