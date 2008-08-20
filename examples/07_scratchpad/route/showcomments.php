<?php
$this->dispatch($this->DIR_ROOT . 'action/display');
$this->title = $this->pad->title;
$this->dispatch($this->DIR_APP . 'tpl/header');
$this->dispatch($this->DIR_APP . 'tpl/breadcrumbs');
$this->dispatch($this->DIR_APP . 'tpl/nav');
$this->dispatch($this->DIR_APP . 'tpl/comments');
$this->dispatch($this->DIR_APP . 'tpl/footer');
// EOF