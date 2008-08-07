<?php

$request = $this->dispatch(ROOT_DIR . 'load/request');
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
if( isset($request->scratchpad_body) ) {
    $body = $this->dispatch(ROOT_DIR . 'load/markdownify')->parseString($request->scratchpad_body);
    $baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
    $body = str_replace($baseurl, '', $body);
    $pad->body = $body; filter_var($body,  FILTER_SANITIZE_STRING );
    $pad->author = $this->dispatch(ROOT_DIR . 'load/session')->user_id;
}
$header = $this->dispatch(ROOT_DIR . 'load/header');
$header->title = $header->title . ' - Edit';
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/nav');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/forms/wmd');
$this->dispatch(ROOT_DIR . 'layout/global/footer');

//EOF