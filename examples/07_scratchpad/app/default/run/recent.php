<?php
$this->dispatch($this->DIR_ACTION . 'recent');
$this->title = 'Blog-style listing for [' . $this->pad->title . ']';
$this->dispatch($this->DIR_APP . 'tpl/header'); 
$this->dispatch($this->DIR_APP . 'tpl/nav');
$this->dispatch($this->DIR_APP . 'tpl/summarylist');
$this->dispatch($this->DIR_APP . 'tpl/footer');

// EOF