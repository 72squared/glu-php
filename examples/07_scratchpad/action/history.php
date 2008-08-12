<?php
$this->dispatch( dirname(__FILE__) . '/display');
$this->lister = $this->Scratchpad_Lister( array_slice($this->pad->history(), 0, 20) );
$this->authors = $this->Scratchpad_Authors( $this->lister );

//EOF