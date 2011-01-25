<?php
$this->dispatch($this->dir->ACTION . 'listusers');
$this->title = 'LIST USERS';
$this->dispatch($this->dir->VIEW . 'site/header'); 
$this->dispatch($this->dir->VIEW . 'admin/listusers');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF
