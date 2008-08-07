<?php
$s = new Scratchpad_Storage();
$recent_ids = array_slice($s->recentIds(), 0, 20);
$lister = new Scratchpad_Lister( $recent_ids );
$this->instance( array('lister'=>$lister, 'baseurl'=>$this->dispatch(ROOT_DIR . 'load/baseurl')) )->dispatch(ROOT_DIR . 'layout/scratchpad/list');
//EOF