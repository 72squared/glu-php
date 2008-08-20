<?php
$this->dispatch($this->DIR_ROOT . 'action/manageuser');
$this->title = 'MANAGE USER';
$this->dispatch($this->DIR_APP . 'tpl/header'); 
$this->dispatch($this->DIR_APP . 'tpl/manageuser');
$this->dispatch($this->DIR_APP . 'tpl/footer');
