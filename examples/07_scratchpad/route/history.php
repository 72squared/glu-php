<?php
$title =  $this->dispatch(ROOT_DIR . 'load/scratchpad')->title;
$this->dispatch(ROOT_DIR . 'load/header')->title = $title . ' - History';
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/history');
$this->dispatch(ROOT_DIR . 'layout/global/footer');
//EOF