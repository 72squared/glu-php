<?php
$pad = $this->dispatch( ROOT_DIR . 'load/scratchpad');
$recent_ids = array_slice($pad->descendentsHistory(), 0, 20);
$lister = new Scratchpad_Lister( $recent_ids );
$title = 'Recent changes';
$this->instance( array('lister'=>$lister, 'title'=>$title) )->dispatch(ROOT_DIR . 'layout/scratchpad/list');
//EOF