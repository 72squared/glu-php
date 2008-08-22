<?php
if( $this->pad->image && $this->request->route !='display') {
    $this->dispatch($this->dir->TPL . 'scratchpad/image');
    return;
}

$this->title = $this->pad->title;
$this->dispatch($this->dir->TPL . 'site/header');
$this->dispatch($this->dir->TPL . 'scratchpad/display');
$this->dispatch($this->dir->TPL . 'site/footer');
//EOF