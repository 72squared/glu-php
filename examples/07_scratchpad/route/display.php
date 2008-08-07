<?php
if( $this->dispatch(ROOT_DIR . 'layout/global/static') ) return;
if( $this->dispatch(ROOT_DIR . 'layout/scratchpad/text') ) return;

$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/nav');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/display');
$this->dispatch(ROOT_DIR . 'layout/global/footer');
//EOF