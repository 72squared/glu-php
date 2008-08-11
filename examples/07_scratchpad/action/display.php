<?php

if( ! $this->path ) throw new Exception('invalid-path');

$d = $this->Grok();
$d->baseurl = $this->baseurl;
$session = $d->session = $this->Session();
$user = $d->user = $this->User( $session->user_id );

$pad = $this->ScratchPad( $this->path );

$author =  new User( $pad->author );
$nickname = ( $author->nickname ) ? $author->nickname : 'Anonymous'; 
$parser = $this->Markdown_Parser();
$body = $pad->body;
if( ! $pad->entry_id ) $body = '#directory only';
if( ! $pad->dir_id )  $body = '#Page does not exist yet';
$body = $parser->transform($body);
$body = preg_replace('#<a[\s]+href="([a-z0-9_\-\/\.]+)"#i', '<a href="' . $this->baseurl . '${1}"', $body);
$d->pad = $pad;
$d->title = $pad->title;
$d->path = $pad->path;
$d->entry_id = $pad->entry_id;
$d->dir_id = $pad->dir_id;
$d->body = $body;
$d->nickname = $nickname;
$d->created = $pad->created ? date('Y/m/d H:i:s', $pad->created ) : '';
return $d;