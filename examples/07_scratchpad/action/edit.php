<?php
$title =  $this->dispatch(ROOT_DIR . 'load/scratchpad')->title .' - Edit';
$request = $this->dispatch(ROOT_DIR . 'load/request');
if( isset($request->scratchpad_body) ) {
    if( ! $this->dispatch( ROOT_DIR . 'load/nonce' )->validate( $request->nonce ) ){
        throw new Exception('invalid-nonce');
    }
    $pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
    $body = $this->dispatch(ROOT_DIR . 'load/markdownify')->parseString($request->scratchpad_body);
    $baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
    $body = str_replace($baseurl, '', $body);
    $pad->body = $body; filter_var($body,  FILTER_SANITIZE_STRING );
    $pad->author = $this->dispatch(ROOT_DIR . 'load/session')->user_id;
    $pad->store();
    $title .= ' ( success )';
}
$this->dispatch(ROOT_DIR . 'load/header')->title = $title;
$this->dispatch(ROOT_DIR . 'layout/global/header');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/nav');
$this->dispatch(ROOT_DIR . 'layout/scratchpad/forms/wmd');
$this->dispatch(ROOT_DIR . 'layout/global/footer');

//EOF