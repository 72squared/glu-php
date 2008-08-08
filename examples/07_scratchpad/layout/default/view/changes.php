<?php
$d = $this->dispatch(ROOT_DIR . 'action/changes');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$d->dispatch($tpl . 'header'); 
$d->dispatch($tpl . 'nav');
$d->dispatch($tpl . 'list');
$d->dispatch($tpl . 'footer');

// EOF