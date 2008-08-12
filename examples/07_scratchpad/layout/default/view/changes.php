<?php
$this->dispatch(ROOT_DIR . 'action/changes');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$this->title = 'changes for ' . $this->pad->title;
$this->dispatch($tpl . 'header'); 
$this->dispatch($tpl . 'nav');
$this->dispatch($tpl . 'list');
$this->dispatch($tpl . 'footer');

// EOF