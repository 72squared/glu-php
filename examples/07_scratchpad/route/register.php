<?php
$this->dispatch($this->DIR_ACTION . 'register');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_ROUTE . 'display');
$this->title = 'Register';
$this->dispatch($this->DIR_TPL . 'site/header'); 
$this->dispatch($this->DIR_TPL . 'auth/registerform');
$this->dispatch($this->DIR_TPL . 'site/footer');

// EOF