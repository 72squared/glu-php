<?php
$this->dispatch($this->dir->ACTION . 'register');
if( $this->user->user_id ) return $this->dispatch( $this->dir->ROUTE . 'display');
$this->title = 'Register';
$this->dispatch($this->dir->VIEW . 'site/header'); 
$this->dispatch($this->dir->VIEW . 'auth/registerform');
$this->dispatch($this->dir->VIEW . 'site/footer');

// EOF