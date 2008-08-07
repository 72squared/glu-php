<?php
$s = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$history_ids = array_slice($s->history(), 0, 20);
$lister = new Scratchpad_Lister( $history_ids );
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$title = 'Changes for [' . $s->title . ']';
$this->instance( array('lister'=>$lister, 'baseurl'=>$baseurl, 'title'=>$title) )->dispatch(ROOT_DIR . 'layout/scratchpad/list');
// EOF;