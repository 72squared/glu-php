<?php
$this->title = 'Sign In via gmail';
$this->dispatch($this->dir->TPL . 'site/header'); 
$this->dispatch($this->dir->TPL . 'auth/loginmailrestrictedform');
$this->dispatch($this->dir->TPL . 'site/footer');
// EOF