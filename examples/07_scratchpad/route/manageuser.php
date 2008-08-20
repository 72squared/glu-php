<?php
$this->dispatch($this->DIR_ACTION . 'manageuser');
$this->title = 'MANAGE USER';
$this->dispatch($this->DIR_TPL . 'site/header'); 
$this->dispatch($this->DIR_TPL . 'admin/manageuser');
$this->dispatch($this->DIR_TPL . 'site/footer');
