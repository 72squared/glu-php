<?php
$this->dispatch($this->dir->ACTION . 'keywordsearch');
$this->title = 'Keyword Search for "' . $this->request->term . '"';
$this->dispatch($this->dir->VIEW . 'site/header');
$this->dispatch($this->dir->VIEW . 'scratchpad/list');
$this->dispatch($this->dir->VIEW . 'site/footer');

// EOF