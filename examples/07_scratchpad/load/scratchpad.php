<?php
$key = '_' . md5(__FILE__);
if( $this->$key instanceof Scratchpad ) return $this->$key;
$request = $this->dispatch(ROOT_DIR . 'load/request');
if( $request->entry_id ) return $this->$key = new ScratchPad( $request->entry_id );
$path = $this->dispatch(ROOT_DIR . 'load/path');
if(substr($path, -5) == '.text') $path = substr($path, 0, -5);
return $this->$key = new ScratchPad( $path );

// EOF