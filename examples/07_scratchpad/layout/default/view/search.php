<?php

$this->dispatch(ROOT_DIR . 'action/search');

$tpl = dirname(dirname(__FILE__)) . '/tpl/';

$this->dispatch($tpl . 'header'); 
$this->dispatch($tpl . 'nav');

$this->title = 'Title Search';
$this->lister = $this->titles;
$this->dispatch($tpl . 'list');

$this->title = 'Keyword Search';
$this->lister = $this->keywords;
$this->dispatch($tpl . 'list');

$this->dispatch($tpl . 'footer');

// EOF