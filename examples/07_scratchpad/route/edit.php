<?php
$this->dispatch($this->DIR_ACTION . 'edit');
$this->title = $this->pad->title . ' - EDIT';
$this->dispatch($this->DIR_APP . 'tpl/header');
$this->dispatch($this->DIR_APP . 'tpl/breadcrumbs');
$this->dispatch($this->DIR_APP . 'tpl/nav');
$this->dispatch($this->DIR_APP . 'tpl/editform');
$this->dispatch($this->DIR_APP . 'tpl/footer');
// EOF