<?php
$this->dispatch($this->DIR_ACTION . 'loginmail');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_ROUTE . 'display');
$this->title = 'Sign In via Mail';
$this->dispatch($this->DIR_TPL . 'header'); 
$this->dispatch($this->DIR_TPL . 'loginmailform');
$this->dispatch($this->DIR_TPL . 'footer');

// EOF