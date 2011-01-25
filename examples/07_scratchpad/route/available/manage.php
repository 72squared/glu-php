<?php
$this->dispatch($this->dir->ACTION . 'manage');
$this->title = 'Manage - ' . $this->pad->title;
$this->dispatch( $this->dir->VIEW . 'site/header');
$this->dispatch( $this->dir->VIEW . 'admin/manageform');
$this->dispatch( $this->dir->VIEW . 'site/footer');
// EOF