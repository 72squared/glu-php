<?php
$this->title = 'Sign In via Mail';
$this->dispatch($this->DIR_TPL . 'site/header'); 
$this->dispatch($this->DIR_TPL . 'auth/loginmailform');
$this->dispatch($this->DIR_TPL . 'site/footer');
//EOF