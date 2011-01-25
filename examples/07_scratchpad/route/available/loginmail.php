<?php
$this->dispatch($this->dir->ACTION . 'loginmail');
if( $this->user->user_id ) return $this->dispatch( $this->dir->ROUTE . 'display');
$this->title = 'Sign In via Mail';
$this->dispatch($this->dir->VIEW . 'site/header'); 
$this->dispatch($this->dir->VIEW . 'auth/loginmailform');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF