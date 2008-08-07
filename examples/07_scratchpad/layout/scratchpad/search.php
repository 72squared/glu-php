<?php
$term = $this->dispatch(ROOT_DIR . 'load/request')->term;
$pad = $this->dispatch( ROOT_DIR . 'load/scratchpad');
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$tpl = ROOT_DIR . 'layout/scratchpad/list';

$title = 'title search';
$lister = new Scratchpad_Lister( $pad->find( $term ) );
$this->instance( array('lister'=>$lister, 'baseurl'=>$baseurl, 'title'=>$title) )->dispatch($tpl);

$title = 'keyword search';
$lister = new Scratchpad_Lister( $pad->search($term) );
$this->instance( array('lister'=>$lister, 'baseurl'=>$baseurl, 'title'=>$title) )->dispatch($tpl);

// EOF