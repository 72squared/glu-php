<?php
$this->title = 'Register';
$this->dispatch($this->dir->TPL . 'site/header'); 
$this->dispatch($this->dir->TPL . 'auth/registerform');
$this->dispatch($this->dir->TPL . 'site/footer');
