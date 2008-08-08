<?php
$d = $this->dispatch(ROOT_DIR . 'action/display');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$d->route = 'display';
$d->dispatch($tpl . 'header'); 
$d->dispatch($tpl . 'nav');
$d->dispatch($tpl . 'display');
$d->dispatch($tpl . 'footer');
// EOF