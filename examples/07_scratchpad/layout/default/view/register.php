<?php
$d = $this->dispatch(ROOT_DIR . 'action/register');
if( $d->user->user_id ) return $this->dispatch( ROOT_DIR . 'app/display');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$d->dispatch($tpl . 'header'); 
$d->dispatch($tpl . 'registerform');
$d->dispatch($tpl . 'footer');

// EOF