<?php
$this->dispatch($this->DIR_ACTION . 'descendents');
$this->title = 'Descendents for ' . $this->pad->title;
$this->dispatch($this->DIR_APP . 'tpl/header');
$this->dispatch($this->DIR_APP . 'tpl/breadcrumbs');
$this->dispatch($this->DIR_APP . 'tpl/nav');
$this->dispatch($this->DIR_APP . 'tpl/list');
$this->dispatch($this->DIR_APP . 'tpl/footer');
// EOF