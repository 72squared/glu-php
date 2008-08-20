<?php
$this->dispatch($this->DIR_ACTION . 'login');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_ROUTE . 'display');
$this->dispatch($this->DIR_VIEW . 'login');
// EOF