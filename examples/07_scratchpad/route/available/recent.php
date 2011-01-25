<?php
$this->dispatch($this->dir->ACTION . 'recent');
$this->title = 'Blog-style listing for [' . $this->pad->title . ']';
$this->dispatch($this->dir->VIEW . 'site/header');
$this->dispatch($this->dir->VIEW . 'scratchpad/summarylist');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF