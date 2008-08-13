<?php
$this->dispatch($this->DIR_ACTION . 'login');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_APP . 'run/display');
$this->title = 'Sign In';
$this->dispatch($this->DIR_APP . 'tpl/header'); 
$this->dispatch($this->DIR_APP . 'tpl/loginform');
$this->dispatch($this->DIR_APP . 'tpl/footer');

// EOF