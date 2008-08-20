<?php
$this->dispatch($this->DIR_ACTION . 'loginmail');
if( $this->user->user_id ) return $this->dispatch( $this->DIR_ROUTE . 'display');
$this->dispatch($this->DIR_VIEW . 'loginmail');
// EOF