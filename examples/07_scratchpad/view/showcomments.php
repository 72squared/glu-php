<?php
$this->title = $this->pad->title;
$this->dispatch($this->DIR_TPL . 'site/header');
$this->dispatch($this->DIR_TPL . 'scratchpad/comments');
$this->dispatch($this->DIR_TPL . 'site/footer');
// EOF