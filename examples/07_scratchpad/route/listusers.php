<?php
$this->dispatch($this->DIR_ROOT . 'action/listusers');
$this->title = 'LIST USERS';
$this->dispatch($this->DIR_APP . 'tpl/header'); 
$this->dispatch($this->DIR_APP . 'tpl/listusers');
$this->dispatch($this->DIR_APP . 'tpl/footer');
