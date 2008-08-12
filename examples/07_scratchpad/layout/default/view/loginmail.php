<?php
$this->dispatch(ROOT_DIR . 'action/loginmail');
if( $this->user->user_id ) return $this->dispatch( dirname(__FILE__) . '/display');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$this->title = 'Sign In via Mail';
$this->dispatch($tpl . 'header'); 
$this->dispatch($tpl . 'loginmailform');
$this->dispatch($tpl . 'footer');

// EOF