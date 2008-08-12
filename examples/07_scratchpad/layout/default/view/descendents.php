<?php
$this->dispatch(ROOT_DIR . 'action/descendents');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$this->title = 'Descendents for ' . $this->pad->title;
$this->dispatch($tpl . 'header'); 
$this->dispatch($tpl . 'nav');
$this->dispatch($tpl . 'list');
$this->dispatch($tpl . 'footer');
// EOF