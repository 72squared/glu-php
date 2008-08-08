<?php

$d = $this->dispatch(ROOT_DIR . 'action/search');

$tpl = dirname(dirname(__FILE__)) . '/tpl/';

$d->dispatch($tpl . 'header'); 
$d->dispatch($tpl . 'nav');

$d->title = 'Title Search';
$d->lister = $d->titles;
$d->dispatch($tpl . 'list');

$d->title = 'Keyword Search';
$d->lister = $d->keywords;
$d->dispatch($tpl . 'list');

$d->dispatch($tpl . 'footer');

// EOF