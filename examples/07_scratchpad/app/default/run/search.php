<?php

$this->dispatch($this->DIR_ACTION . 'search');
$this->title = 'Search';
$this->dispatch($this->DIR_APP . 'tpl/header'); 
$this->dispatch($this->DIR_APP . 'tpl/nav');

$this->title = 'Title Search';
$this->lister = $this->titles;
$this->dispatch($this->DIR_APP . 'tpl/list');

$this->title = 'Keyword Search';
$this->lister = $this->keywords;
$this->dispatch($this->DIR_APP . 'tpl/list');

$this->dispatch($this->DIR_APP . 'tpl/footer');

// EOF