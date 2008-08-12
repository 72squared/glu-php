<?php
$this->dispatch( ROOT_DIR . 'action/error');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$this->dispatch($tpl . 'header');
$this->dispatch($tpl . 'message');
$this->dispatch($tpl . 'footer'); 
// EOF