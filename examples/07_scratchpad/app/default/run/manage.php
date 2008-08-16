<?php
$this->dispatch($this->DIR_ACTION . 'manage');
$this->title = 'Manage Area -' . $this->pad->area;
$this->dispatch( $this->DIR_APP . 'tpl/header');
$this->dispatch( $this->DIR_APP . 'tpl/nav');
$this->dispatch( $this->DIR_APP . 'tpl/manageform');
$this->dispatch( $this->DIR_APP . 'tpl/footer');

// EOF