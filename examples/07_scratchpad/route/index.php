<?php
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$header = $this->dispatch(ROOT_DIR . 'load/header');
$header->title = $header->title . ' - Related';
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/descendents');
$this->dispatch(ROOT_DIR . 'layout/global/footer');
//EOF