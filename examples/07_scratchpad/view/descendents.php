<?php
$this->title = 'Descendents for ' . $this->pad->title;
$this->dispatch($this->dir->TPL . 'site/header');
$this->dispatch($this->dir->TPL . 'scratchpad/list');
$this->dispatch($this->dir->TPL . 'site/footer');
// EOF