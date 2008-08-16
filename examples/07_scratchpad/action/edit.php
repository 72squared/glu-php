<?php
$this->dispatch( dirname(__FILE__) . '/display');
$session = ( $this->session ) ? $this->session :  $this->Grok();
$nonce =  $this->Nonce( $session->session_id .  $this->pad->entry_id );
$this->nonce = $nonce->create();
if( ! isset($this->request->body) ) return;
if( ! $nonce->validate( $this->request->nonce ) ) throw $this->Exception('invalid-nonce');
$this->pad->body = str_replace($this->baseurl, '', $this->Markdownify()->parseString($this->request->body));
$this->pad->area = $this->request->area;
$this->pad->author = $session->user_id;
$this->pad->store();
$nonce =  $this->Nonce( $session->session_id .  $this->pad->entry_id );
$this->nonce = $nonce->create();
//EOF