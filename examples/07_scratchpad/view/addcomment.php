<?php
$this->title = $this->pad->title . ' - Add Comment';
$this->dispatch($this->dir->TPL . 'site/header');
$this->dispatch($this->dir->TPL . 'scratchpad/addcommentform');
$this->dispatch($this->dir->TPL . 'site/footer');

// EOF