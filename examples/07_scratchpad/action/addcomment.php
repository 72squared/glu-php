<?php
$this->dispatch( dirname(__FILE__) . '/load');
$pad = $this->pad;
$this->comment = $this->scratchPad( array('dir_id'=>$pad->dir_id, 'path'=>$pad->path, 'entry_type'=>1) );
$session = ( $this->session ) ? $this->session :  $this->Grok();
$nonce =  $this->Nonce( $session->session_id .  $this->comment->dir_id );
$this->nonce = $nonce->create();
if( ! isset($this->request->body) ) return;
if( ! $nonce->validate( $this->request->nonce ) ) throw $this->Exception('invalid-nonce');
$this->comment->body = str_replace($this->baseurl, '', $this->Markdownify()->parseString($this->request->body));
$this->comment->author = $session->user_id;
$this->comment->store();
$nonce =  $this->Nonce( $session->session_id .  $this->comment->dir_id );
$this->nonce = $nonce->create();
//EOF