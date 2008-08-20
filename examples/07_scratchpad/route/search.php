<?php
$this->dispatch($this->DIR_ACTION . 'keywordsearch');
$this->title = 'Keyword Search for "' . $this->request->term . '"';
$this->dispatch($this->DIR_TPL . 'header');
$this->dispatch($this->DIR_TPL . 'breadcrumbs');
$this->dispatch($this->DIR_TPL . 'nav');
$this->dispatch($this->DIR_TPL . 'list');
$this->dispatch($this->DIR_TPL . 'footer');

// EOF