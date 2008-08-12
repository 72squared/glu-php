<?php
if( ! $this->path ) throw new Exception('invalid-path');
$this->session = $this->Session();
$this->user = $this->User( $this->session->user_id );
$this->pad = $this->ScratchPad( $this->path );
$this->author =  $this->User( $this->pad->author );

// EOF