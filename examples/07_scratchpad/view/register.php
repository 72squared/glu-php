<?php
$this->title = 'Register';
$this->dispatch($this->DIR_TPL . 'site/header'); 
$this->dispatch($this->DIR_TPL . 'auth/registerform');
$this->dispatch($this->DIR_TPL . 'site/footer');
