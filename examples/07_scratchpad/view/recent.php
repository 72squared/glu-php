<?php
$this->title = 'Blog-style listing for [' . $this->pad->title . ']';
$this->dispatch($this->dir->TPL . 'site/header');
$this->dispatch($this->dir->TPL . 'scratchpad/summarylist');
$this->dispatch($this->dir->TPL . 'site/footer');
// EOF