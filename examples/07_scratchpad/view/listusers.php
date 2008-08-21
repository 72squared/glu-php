<?php
$this->title = 'LIST USERS';
$this->dispatch($this->dir->TPL . 'site/header'); 
$this->dispatch($this->dir->TPL . 'admin/listusers');
$this->dispatch($this->dir->TPL . 'site/footer');
// EOF