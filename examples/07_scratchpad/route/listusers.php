<?php
$this->dispatch($this->DIR_ACTION . 'listusers');
$this->title = 'LIST USERS';
$this->dispatch($this->DIR_TPL . 'header'); 
$this->dispatch($this->DIR_TPL . 'listusers');
$this->dispatch($this->DIR_TPL . 'footer');
