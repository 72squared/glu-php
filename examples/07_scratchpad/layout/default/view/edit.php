<?php
$this->dispatch(ROOT_DIR . 'action/edit');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$this->title = $this->pad->title . ' - EDIT';
$this->dispatch($tpl . 'header'); 
$this->dispatch($tpl . 'nav');
$this->dispatch($tpl . 'editform');
$this->dispatch($tpl . 'footer');
// EOF