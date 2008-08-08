<?php
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$author = $this->dispatch(ROOT_DIR . 'load/author');
$nickname = ( $author->nickname ) ? $author->nickname : 'Anonymous'; 
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$body = ( $pad->body ) ? $pad->body : '#Page does not exist yet';
$body = htmlspecialchars($body);
$action = $baseurl . $pad->path;
$nonce = $this->dispatch( ROOT_DIR . 'load/nonce')->create();

$details = new Grok;
$details->path = $pad->path;
$details->entry_id = $pad->entry_id;
$details->dir_id = $pad->dir_id;
$details->body = $body;
$details->created = $pad->created ? date('Y/m/d H:i:s', $pad->created ) : '';
$details->action = $action;
$details->nonce = $nonce;
$details->baseurl = $baseurl;
$details->nickname = $nickname;
return $details;