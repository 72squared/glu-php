<?php
$this->title = 'Sign In via gmail';
$this->dispatch($this->DIR_TPL . 'site/header'); 
$this->dispatch($this->DIR_TPL . 'auth/loginmailrestrictedform');
$this->dispatch($this->DIR_TPL . 'site/footer');
// EOF