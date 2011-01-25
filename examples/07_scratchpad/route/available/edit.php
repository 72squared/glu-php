<?php
$this->dispatch($this->dir->ACTION . 'edit');
$this->title = $this->pad->title . ' - EDIT';
$this->dispatch($this->dir->VIEW . 'site/header');
$this->dispatch($this->dir->VIEW . 'scratchpad/editform');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF