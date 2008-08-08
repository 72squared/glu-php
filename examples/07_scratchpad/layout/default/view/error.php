<?php
$d = $this->dispatch( ROOT_DIR . 'action/error');
$d->baseurl = $this->baseurl;
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$d->dispatch($tpl . 'header');
$d->dispatch($tpl . 'message');
$d->dispatch($tpl . 'footer'); 
// EOF