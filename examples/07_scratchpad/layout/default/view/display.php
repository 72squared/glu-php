<?php
$this->dispatch(ROOT_DIR . 'action/display');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$this->title = $this->pad->title;

$this->dispatch($tpl . 'header'); 
$this->dispatch($tpl . 'nav');
$this->dispatch($tpl . 'display');
$this->dispatch($tpl . 'footer');
// EOF