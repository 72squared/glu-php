<?php
$this->dispatch($this->DIR_ACTION . 'manageuser');
$this->title = 'MANAGE USER';
$this->dispatch($this->DIR_TPL . 'header'); 
$this->dispatch($this->DIR_TPL . 'manageuser');
$this->dispatch($this->DIR_TPL . 'footer');
