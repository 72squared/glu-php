<?php
$term = $this->dispatch(ROOT_DIR . 'load/request')->term;
$s = new Scratchpad_Storage();
$lister = new Scratchpad_Lister( $v = $s->search('%' . $term . '%') );
$this->instance( array('lister'=>$lister, 'baseurl'=>$this->dispatch(ROOT_DIR . 'load/baseurl')) )->dispatch(ROOT_DIR . 'layout/scratchpad/list');
// EOF