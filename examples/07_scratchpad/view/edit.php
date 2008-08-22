<?php
$this->title = $this->pad->title . ' - EDIT';
$this->dispatch($this->dir->TPL . 'site/header');
$this->dispatch($this->dir->TPL . 'scratchpad/editform');
$this->dispatch($this->dir->TPL . 'site/footer');
//EOF