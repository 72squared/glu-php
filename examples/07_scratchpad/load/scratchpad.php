<?php
$key = '_' . md5(__FILE__);
if( $this->$key instanceof Scratchpad ) return $this->$key;
$request = $this->dispatch(ROOT_DIR . 'load/request');
if( $request->entry_id ) {
    $this->$key = $pad = new ScratchPad( $request->entry_id );
} else {
    $path = $this->dispatch(ROOT_DIR . 'load/path');
    if(substr($path, -5) == '.text') $path = substr($path, 0, -5);
    $this->$key = $pad = new ScratchPad( $path );
}

$title = ucwords(trim(str_replace('/', ' ', str_replace('-', ' ', str_replace('_', ' ', $pad->path)))));
if( ! $title ) $title = 'Home';

if( $request->entry_id ) $title .= ' #' . $pad->entry_id;

$this->dispatch(ROOT_DIR . 'load/header')->title = $title;

return $this->$key;
// EOF