<?php
$this->dispatch(this->DIR_ACTION . 'register');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_APP . 'run/display');
$this->dispatch($this->DIR_APP . 'tpl/header'); 
$this->dispatch($this->DIR_APP . 'tpl/registerform');
$this->dispatch($this->DIR_APP . 'tpl/footer');

// EOF