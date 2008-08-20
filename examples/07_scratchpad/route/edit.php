<?php
$this->dispatch($this->DIR_ACTION . 'edit');
$this->title = $this->pad->title . ' - EDIT';
$this->dispatch($this->DIR_TPL . 'site/header');
$this->dispatch($this->DIR_TPL . 'scratchpad/breadcrumbs');
$this->dispatch($this->DIR_TPL . 'scratchpad/nav');
$this->dispatch($this->DIR_TPL . 'scratchpad/editform');
$this->dispatch($this->DIR_TPL . 'site/footer');
// EOF