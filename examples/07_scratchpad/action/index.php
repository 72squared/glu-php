<?php
$title =  $this->dispatch(ROOT_DIR . 'load/scratchpad')->title;
$this->dispatch(ROOT_DIR . 'load/header')->title = $title . ' - Related Pages';
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/descendents');
$this->dispatch(ROOT_DIR . 'layout/global/footer');
//EOF