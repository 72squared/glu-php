<?php
$path = $this->request->entry_id ? $this->request->entry_id : $this->path;
if( ! $path ) throw new Exception('invalid-path');
$this->session = $this->Session();
$this->user = $this->User( $this->session->user_id );
$this->pad = $this->ScratchPad( $path );
$this->author =  $this->User( $this->pad->author );

// EOF