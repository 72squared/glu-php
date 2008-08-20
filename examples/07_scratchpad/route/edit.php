<?php
$this->dispatch($this->DIR_ACTION . 'edit');
$this->title = $this->pad->title . ' - EDIT';
$this->dispatch($this->DIR_TPL . 'header');
$this->dispatch($this->DIR_TPL . 'breadcrumbs');
$this->dispatch($this->DIR_TPL . 'nav');
$this->dispatch($this->DIR_TPL . 'editform');
$this->dispatch($this->DIR_TPL . 'footer');
// EOF