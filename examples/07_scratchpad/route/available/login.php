<?php
$this->dispatch($this->dir->ACTION . 'login');
if( $this->user->user_id ) return $this->dispatch( $this->dir->ROUTE . 'display');
$this->title = 'Sign In';
$this->dispatch($this->dir->VIEW . 'site/header'); 
$this->dispatch($this->dir->VIEW . 'auth/loginform');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF