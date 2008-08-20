<?php
$this->dispatch($this->DIR_ACTION . 'display');
$this->title = $this->pad->title;
$this->dispatch($this->DIR_TPL . 'site/header');
$this->dispatch($this->DIR_TPL . 'scratchpad/breadcrumbs');
$this->dispatch($this->DIR_TPL . 'scratchpad/nav');
$this->dispatch($this->DIR_TPL . 'scratchpad/display');
$this->dispatch($this->DIR_TPL . 'scratchpad/comments');
$this->dispatch($this->DIR_TPL . 'site/footer');
// EOF