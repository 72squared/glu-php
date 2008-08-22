<?php
$this->title = $this->pad->title . ' - EDIT';
$this->dispatch($this->dir->TPL . 'site/header');
$pos = strrpos($this->pad->path, '.');
$ext = ( $pos ) ? substr($this->pad->path, $pos + 1 ) : '';
if( in_array( $ext, array('jpg', 'png', 'gif') ) ){
    $this->dispatch($this->dir->TPL . 'scratchpad/addimageform');
} else {
    $this->dispatch($this->dir->TPL . 'scratchpad/editform');
}
$this->dispatch($this->dir->TPL . 'site/footer');
//EOF