<?php
$this->title = $this->pad->title;
$this->dispatch($this->dir->TPL . 'site/header');
$this->dispatch($this->dir->TPL . 'scratchpad/comments');
$this->dispatch($this->dir->TPL . 'site/footer');
// EOF