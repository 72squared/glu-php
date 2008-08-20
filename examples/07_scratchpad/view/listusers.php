<?php
$this->title = 'LIST USERS';
$this->dispatch($this->DIR_TPL . 'site/header'); 
$this->dispatch($this->DIR_TPL . 'admin/listusers');
$this->dispatch($this->DIR_TPL . 'site/footer');
// EOF