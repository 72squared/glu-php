<?php
$this->dispatch(ROOT_DIR . 'load/header')->title = 'Recent Changes';
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/changes');
$this->dispatch(ROOT_DIR . 'layout/global/footer');
//EOF