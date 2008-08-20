<?php
$this->title = 'Descendents for ' . $this->pad->title;
$this->dispatch($this->DIR_TPL . 'site/header');
$this->dispatch($this->DIR_TPL . 'scratchpad/list');
$this->dispatch($this->DIR_TPL . 'site/footer');
// EOF