<?php
$this->dispatch($this->DIR_ACTION . 'manage');
$this->title = 'Manage - ' . $this->pad->title;
$this->dispatch( $this->DIR_TPL . 'header');
$this->dispatch($this->DIR_TPL . 'breadcrumbs');
$this->dispatch( $this->DIR_TPL . 'nav');
$this->dispatch( $this->DIR_TPL . 'manageform');
$this->dispatch( $this->DIR_TPL . 'footer');

// EOF