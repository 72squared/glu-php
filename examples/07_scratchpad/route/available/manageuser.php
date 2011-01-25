<?php
$this->dispatch($this->dir->ACTION . 'manageuser');
$this->title = 'MANAGE USER';
$this->dispatch($this->dir->VIEW . 'site/header'); 
$this->dispatch($this->dir->VIEW . 'admin/manageuser');
$this->dispatch($this->dir->VIEW . 'site/footer');