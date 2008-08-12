<?php
$this->session = $this->Session();
$this->user = $this->User( $this->session->user_id );
$this->pad = $this->ScratchPad( $this->path );
$this->lister = $this->Scratchpad_Lister( array_slice($this->pad->children(), 0, 20) );
//EOF