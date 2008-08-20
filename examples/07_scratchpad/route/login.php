<?php
$this->dispatch($this->DIR_ACTION . 'login');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_ROUTE . 'display');
$this->title = 'Sign In';
$this->dispatch($this->DIR_TPL . 'site/header'); 
$this->dispatch($this->DIR_TPL . 'auth/loginform');
$this->dispatch($this->DIR_TPL . 'site/footer');

// EOF