<?php
$this->dispatch($this->DIR_ACTION . 'display');
$this->title = $this->pad->title;
$this->dispatch($this->DIR_APP . 'tpl/header'); 
$this->dispatch($this->DIR_APP . 'tpl/nav');
$this->dispatch($this->DIR_APP . 'tpl/display');
$this->dispatch($this->DIR_APP . 'tpl/footer');
// EOF