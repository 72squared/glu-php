<?php
$this->dispatch( dirname(__FILE__) . '/display');
$this->lister = $this->Scratchpad_Lister( array_slice($this->pad->children(), 0, 20) );
//EOF