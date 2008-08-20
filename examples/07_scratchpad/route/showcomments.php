<?php
$this->dispatch($this->DIR_ACTION . 'display');
$this->title = $this->pad->title;
$this->dispatch($this->DIR_TPL . 'header');
$this->dispatch($this->DIR_TPL . 'breadcrumbs');
$this->dispatch($this->DIR_TPL . 'nav');
$this->dispatch($this->DIR_TPL . 'comments');
$this->dispatch($this->DIR_TPL . 'footer');
// EOF