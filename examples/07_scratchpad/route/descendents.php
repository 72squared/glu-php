<?php
$this->dispatch($this->DIR_ACTION . 'descendents');
$this->title = 'Descendents for ' . $this->pad->title;
$this->dispatch($this->DIR_TPL . 'header');
$this->dispatch($this->DIR_TPL . 'breadcrumbs');
$this->dispatch($this->DIR_TPL . 'nav');
$this->dispatch($this->DIR_TPL . 'list');
$this->dispatch($this->DIR_TPL . 'footer');
// EOF