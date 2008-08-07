<?php
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$lister = new Scratchpad_Lister( $pad->descendents() );
$title = 'Index for: [' . $pad->title . ']';
$this->instance( array('lister'=>$lister,'title'=>$title) )->dispatch(ROOT_DIR . 'layout/scratchpad/list');
//EOF