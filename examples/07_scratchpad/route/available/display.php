<?php
$this->dispatch($this->dir->ACTION . 'display');
if( $this->pad->image && $this->request->route !='display') {
    $this->dispatch($this->dir->VIEW . 'scratchpad/image');
    return;
}

$this->title = $this->pad->title;
$this->dispatch($this->dir->VIEW . 'site/header');
$this->dispatch($this->dir->VIEW . 'scratchpad/display');
$this->dispatch($this->dir->VIEW . 'site/footer');
// EOF