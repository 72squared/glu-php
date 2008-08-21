<?php
$this->dispatch($this->dir->ACTION . 'register');
if( $this->user->user_id ) return $this->dispatch( $this->dir->ROUTE . 'display');
$this->dispatch($this->dir->VIEW . 'register');

// EOF