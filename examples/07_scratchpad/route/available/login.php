<?php
$this->dispatch($this->dir->ACTION . 'login');
if( $this->user->user_id ) return $this->dispatch( $this->dir->ROUTE . 'display');
$this->dispatch($this->dir->VIEW . 'login');
// EOF