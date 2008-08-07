<?php
$lister = new Scratchpad_Lister( $this->dispatch(ROOT_DIR . 'load/scratchpad')->descendents() );
$this->instance( array('lister'=>$lister, 'baseurl'=>$this->dispatch(ROOT_DIR . 'load/baseurl')) )->dispatch(ROOT_DIR . 'layout/scratchpad/list');
//EOF