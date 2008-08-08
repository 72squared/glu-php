<?php
$d = $this->dispatch(ROOT_DIR . 'action/edit');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$d->dispatch($tpl . 'header'); 
$d->dispatch($tpl . 'nav');
$d->dispatch($tpl . 'editform');
$d->dispatch($tpl . 'footer');
// EOF