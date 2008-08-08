<?php
$d = $this->dispatch(ROOT_DIR . 'action/login');
if( $d->user->user_id ) return $this->dispatch( dirname(__FILE__) . '/display');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$d->dispatch($tpl . 'header'); 
$d->dispatch($tpl . 'loginform');
$d->dispatch($tpl . 'footer');

// EOF