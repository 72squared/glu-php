<?php
$this->dispatch( $this->dir->ACTION . 'load');
$session = ( $this->session ) ? $this->session :  $this->NEW->Grok();
$nonce =  $this->NEW->Nonce( $session->session_id .  $this->pad->entry_id );
$this->nonce = $nonce->create();
if( ! isset($this->request->body) ) return;
if( ! $nonce->validate( $this->request->nonce ) ) throw $this->NEW->Exception('invalid-nonce');

if( is_array( $this->request->body ) ){
    $imageinfo = $this->NEW->Grok($this->request->body );
    if( $imageinfo->error ) throw $this->NEW->Exception('upload-err: ' . $imageinfo->error);
    if( ! $imageinfo->size ) throw $this->NEW->Exception('no-file-uploaded');
    if( $imageinfo->size > 500000 ) throw $this->NEW->Exception('file-too-large');
    $ext = substr($this->path, strrpos($this->pad->path, '.') + 1);
    $extensions = 
    array(  'gif'=> 'image/gif',
            'jpg'=> 'image/jpeg',
            'png'=> 'image/png',
            'ico'=> 'image/x-icon',
            'css'=> 'text/plain',
            'js'=>  'text/plain',
    );
    if( ! isset( $extensions[ $ext ] ) ) throw $this->NEW->Exception('unsupported-filetype');
    if( $imageinfo->type != $extensions[$ext] ) throw $this->NEW->Exception('filetype-mismatch');
    $this->pad->body = file_get_contents($imageinfo->tmp_name);
    $this->pad->image = $imageinfo->type;
} else {
    $this->pad->body = str_replace($this->selfurl, '', $this->NEW->Markdownify()->parseString($this->request->body));
}
$this->pad->author = $session->user_id;
$this->pad->store();
$nonce =  $this->NEW->Nonce( $session->session_id .  $this->pad->entry_id );
$this->nonce = $nonce->create();
//EOF