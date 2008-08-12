<?php
$this->session = $this->Session();
$this->user = $this->User( $this->session->user_id );
$this->pad = ( $this->request->entry_id ) ? $this->ScratchPad( $this->request->entry_id ) : $this->ScratchPad( $this->path );
$this->author =  new User( $this->pad->author );

if( isset($this->request->body) ) {
    $nonce = $this->Nonce( $this->session->session_id .  $this->pad->entry_id );
    if( ! $nonce->validate( $this->request->nonce ) ){
        throw new Exception('invalid-nonce');
    }
    $this->pad->body = str_replace($this->baseurl, '', $this->Markdownify()->parseString($this->request->body));
    $this->pad->author = $this->session->user_id;
    //$this->pad->acl = ($this->request->acl ) ? $this->request->acl : NULL;
    $this->pad->store();
}
$this->nonce = $this->Nonce( $this->session->session_id .  $this->pad->entry_id )->create();


//EOF