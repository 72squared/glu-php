<?php
$this->dispatch(ROOT_DIR . 'action/login');
if( $this->user->user_id ) return $this->dispatch( dirname(__FILE__) . '/display');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$this->title = 'Sign In';
$this->dispatch($tpl . 'header'); 
$this->dispatch($tpl . 'loginform');
$this->dispatch($tpl . 'footer');

// EOF