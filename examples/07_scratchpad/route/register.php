<?php
$this->dispatch($this->DIR_ACTION . 'register');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_ROUTE . 'display');
$this->dispatch($this->DIR_VIEW . 'register');

// EOF