<?php
$this->dispatch($this->DIR_ACTION . 'children');
$this->title = 'children for ' . $this->pad->title;
$this->dispatch($this->DIR_TPL . 'site/header');
$this->dispatch($this->DIR_TPL . 'scratchpad/breadcrumbs');
$this->dispatch($this->DIR_TPL . 'scratchpad/nav');
$this->dispatch($this->DIR_TPL . 'scratchpad/list');
$this->dispatch($this->DIR_TPL . 'site/footer');

// EOF