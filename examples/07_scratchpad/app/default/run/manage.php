<?php
$this->dispatch($this->DIR_ACTION . 'manage');
$this->title = 'Manage Area -' . $this->acl->name();
$this->dispatch( $this->DIR_APP . 'tpl/header');
$this->dispatch($this->DIR_APP . 'tpl/breadcrumbs');
$this->dispatch( $this->DIR_APP . 'tpl/nav');
$this->dispatch( $this->DIR_APP . 'tpl/manageform2');
$this->dispatch( $this->DIR_APP . 'tpl/footer');

// EOF