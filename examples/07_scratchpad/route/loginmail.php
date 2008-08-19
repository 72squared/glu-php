<?php
$this->dispatch($this->DIR_ACTION . 'loginmail');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_APP . 'run/display');
$this->title = 'Sign In via Mail';
$this->dispatch($this->DIR_APP . 'tpl/header'); 
$this->dispatch($this->DIR_APP . 'tpl/loginmailform');
$this->dispatch($this->DIR_APP . 'tpl/footer');

// EOF