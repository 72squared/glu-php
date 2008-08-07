<?php
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$header = $this->dispatch(ROOT_DIR . 'load/header');
$header->title = $header->title . ' - History';
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/history');
$this->dispatch(ROOT_DIR . 'layout/global/footer');
//EOF