<?php
$pad = new Scratchpad_Lister( $this->dispatch(ROOT_DIR . 'load/scratchpad');
$lister = $pad->children() );
$title = 'children of [' . $pad->title . ']';
$this->instance( array('lister'=>$lister, 'title'=>$title) )->dispatch(ROOT_DIR . 'layout/scratchpad/list');
//EOF