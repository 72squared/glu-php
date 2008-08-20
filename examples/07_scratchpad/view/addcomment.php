<?php
$this->title = $this->pad->title . ' - Add Comment';
$this->dispatch($this->DIR_TPL . 'site/header');
$this->dispatch($this->DIR_TPL . 'scratchpad/addcommentform');
$this->dispatch($this->DIR_TPL . 'site/footer');

// EOF