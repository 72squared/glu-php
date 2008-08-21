<?php
$this->title = 'Manage - ' . $this->pad->title;
$this->dispatch( $this->dir->TPL . 'site/header');
$this->dispatch( $this->dir->TPL . 'admin/manageform');
$this->dispatch( $this->dir->TPL . 'site/footer');
// EOF