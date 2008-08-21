<?php
$this->title = 'MANAGE USER';
$this->dispatch($this->dir->TPL . 'site/header'); 
$this->dispatch($this->dir->TPL . 'admin/manageuser');
$this->dispatch($this->dir->TPL . 'site/footer');
// EOF