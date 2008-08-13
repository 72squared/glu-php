<?php
$path = $this->request->entry_id ? $this->request->entry_id : $this->path;
if( ! $path ) throw new Exception('invalid-path');
$this->pad = $this->ScratchPad( $path );
$this->author =  $this->User( $this->pad->author );

// EOF