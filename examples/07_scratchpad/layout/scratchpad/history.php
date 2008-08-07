<?php
$s = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$history_ids = array_slice($s->history(), 0, 20);
$lister = new Scratchpad_Lister( $history_ids );
$this->instance( array('lister'=>$lister, 'baseurl'=>$this->dispatch(ROOT_DIR . 'load/baseurl')) )->dispatch(ROOT_DIR . 'layout/scratchpad/list');
// EOF;