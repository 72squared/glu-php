<?php
$this->title = 'Sign In via Mail';
$this->dispatch($this->dir->TPL . 'site/header'); 
$this->dispatch($this->dir->TPL . 'auth/loginmailform');
$this->dispatch($this->dir->TPL . 'site/footer');
//EOF