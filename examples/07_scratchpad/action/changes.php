<?php
$this->session = $this->Session();
$this->user = $this->User( $this->session->user_id );
$this->pad = $this->ScratchPad( $this->path );
$this->lister = $this->Scratchpad_Lister( array_slice($this->pad->descendentsHistory(), 0, 20) );
$this->authors = $this->Scratchpad_Authors( $this->lister );
//EOF