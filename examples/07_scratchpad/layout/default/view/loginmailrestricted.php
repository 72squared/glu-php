<?php
$this->request->use_ssl = 1;
$this->request->authtype = 'pop3';
$this->request->domain = 'pop.gmail.com';
if( $this->request->email && strpos($this->request->email, '@') === FALSE ) {
    $this->request->email = $this->request->email . '@gmail.com';
}

$this->dispatch(ROOT_DIR . 'action/loginmail');
if( $this->user->user_id ) return $this->dispatch( dirname(__FILE__) . '/display');
$tpl = dirname(dirname(__FILE__)) . '/tpl/';
$this->title = 'Sign In via gmail';
$this->dispatch($tpl . 'header'); 
$this->dispatch($tpl . 'loginmailrestrictedform');
$this->dispatch($tpl . 'footer');

// EOF