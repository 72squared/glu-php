<?php
$this->title = 'Manage - ' . $this->pad->title;
$this->dispatch( $this->DIR_TPL . 'site/header');
$this->dispatch( $this->DIR_TPL . 'admin/manageform');
$this->dispatch( $this->DIR_TPL . 'site/footer');
// EOF