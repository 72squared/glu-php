<?php
$d = $this->instance();
$d->baseurl = $this->baseurl;
$session = $d->session = $this->Session();
$user = $d->user = $this->User( $session->user_id );
$pad = $this->ScratchPad( $this->path );
$author =  new User( $pad->author );

$title =  $pad->title .' - Edit';
$nonce = $this->Nonce( $session->token . $session->session_id .  $pad->entry_id );

if( isset($this->body) ) {
    if( ! $nonce->validate( $this->nonce ) ){
        throw new Exception('invalid-nonce');
    }
    $markdownify = $this->Markdownify();
    $body = $markdownify->parseString($this->body);
    $body = str_replace($this->baseurl, '', $body);
    $pad->body = $body;
    $pad->author = $session->user_id;
    $pad->store();
    $title .= ' ( success )';
}
$nickname = ( $author->nickname ) ? $author->nickname : 'Anonymous'; 
$body = ( $pad->body ) ? $pad->body : '#Page does not exist yet';
$action = $this->baseurl . $pad->path;
$nonce = $this->Nonce( $session->token . $session->session_id .  $pad->entry_id );
$noncekey = $nonce->create();


$d->title = $title;
$d->path = $pad->path;
$d->entry_id = $pad->entry_id;
$d->dir_id = $pad->dir_id;
$d->body = $body;
$d->created = $pad->created ? date('Y/m/d H:i:s', $pad->created ) : '';
$d->action = $action;
$d->nonce = $noncekey;
$d->nickname = $nickname;
return $d;



//EOF