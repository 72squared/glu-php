<?php
$this->title = 'Sign In';
$this->dispatch($this->DIR_TPL . 'site/header'); 
$this->dispatch($this->DIR_TPL . 'auth/loginform');
$this->dispatch($this->DIR_TPL . 'site/footer');
// EOF