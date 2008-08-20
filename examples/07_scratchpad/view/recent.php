<?php
$this->title = 'Blog-style listing for [' . $this->pad->title . ']';
$this->dispatch($this->DIR_TPL . 'site/header');
$this->dispatch($this->DIR_TPL . 'scratchpad/summarylist');
$this->dispatch($this->DIR_TPL . 'site/footer');
// EOF