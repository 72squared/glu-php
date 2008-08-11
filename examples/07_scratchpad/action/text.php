<?php
if( ! $this->path ) throw new Exception('invalid-path');

$d = $this->instance();
$d->baseurl = $this->baseurl;
$d->path = $this->path;
$pad = $this->ScratchPad( $this->path );
$author = $this->User( $pad->author );
$nickname = ( $author->nickname ) ? $author->nickname : 'Anonymous'; 
$body = $pad->body;
if( ! $pad->entry_id ) $body = '#directory only';
if( ! $pad->dir_id )  $body = '#Page does not exist yet';
$d->pad = $pad;
$d->title = $pad->title;
$d->path = $pad->path;
$d->entry_id = $pad->entry_id;
$d->dir_id = $pad->dir_id;
$d->body = $body;
$d->nickname = $nickname;
$d->created = $pad->created ? date('Y/m/d H:i:s', $pad->created ) : '';
return $d;