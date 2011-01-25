<?php
$this->request->use_ssl = 1;
$this->request->authtype = 'pop3';
$this->request->domain = 'pop.gmail.com';
if( $this->request->email && strpos($this->request->email, '@') === FALSE ) {
    $this->request->email = $this->request->email . '@gmail.com';
}
$this->dispatch($this->dir->ACTION . 'loginmail');
if( $this->user->user_id ) return $this->dispatch( $this->dir->ROUTE . 'display');
$this->title = 'Sign In via gmail';
$this->dispatch($this->dir->VIEW . 'site/header'); 
$this->dispatch($this->dir->VIEW . 'auth/loginmailrestrictedform');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF
