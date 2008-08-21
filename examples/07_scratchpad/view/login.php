<?php
$this->title = 'Sign In';
$this->dispatch($this->dir->TPL . 'site/header'); 
$this->dispatch($this->dir->TPL . 'auth/loginform');
$this->dispatch($this->dir->TPL . 'site/footer');
// EOF