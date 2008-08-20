<?php
$this->dispatch($this->DIR_ACTION . 'recent');
$this->title = 'Blog-style listing for [' . $this->pad->title . ']';
$this->dispatch($this->DIR_TPL . 'header');
$this->dispatch($this->DIR_TPL . 'breadcrumbs');
$this->dispatch($this->DIR_TPL . 'nav');
$this->dispatch($this->DIR_TPL . 'summarylist');
$this->dispatch($this->DIR_TPL . 'footer');

// EOF