<?php
$this->dispatch($this->DIR_ACTION . 'login');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_ROUTE . 'display');
$this->title = 'Sign In';
$this->dispatch($this->DIR_TPL . 'header'); 
$this->dispatch($this->DIR_TPL . 'loginform');
$this->dispatch($this->DIR_TPL . 'footer');

// EOF