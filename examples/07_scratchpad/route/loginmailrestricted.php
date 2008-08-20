<?php
$this->request->use_ssl = 1;
$this->request->authtype = 'pop3';
$this->request->domain = 'pop.gmail.com';
if( $this->request->email && strpos($this->request->email, '@') === FALSE ) {
    $this->request->email = $this->request->email . '@gmail.com';
}
$this->dispatch($this->DIR_ROOT . 'action/loginmail');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_APP . 'run/display');
$this->title = 'Sign In via gmail';
$this->dispatch($this->DIR_APP . 'tpl/header'); 
$this->dispatch($this->DIR_APP . 'tpl/loginmailrestrictedform');
$this->dispatch($this->DIR_APP . 'tpl/footer');

// EOF