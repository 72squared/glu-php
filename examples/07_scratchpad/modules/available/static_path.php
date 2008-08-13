<?php
$pos = strrpos($this->path, '.');
if($pos === FALSE ) return;
$ext = substr($this->path, strrpos($this->path, '.') + 1);
$extensions = array( 'gif', 'jpg', 'png', 'css','js');
if( in_array( $ext, $extensions ) ) $this->route = 'static';