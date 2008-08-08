<?php
$d = $this->instance();
$d->baseurl = $this->baseurl;
$session = $d->session = $this->Session();
$user = $d->user = $this->User( $session->user_id );
$pad = $this->ScratchPad( $this->path );
$lister = $this->Scratchpad_Lister( array_slice($pad->descendents(), 0, 20) );
$authors = $this->Scratchpad_Authors( $lister );
$title = 'Descendents';

$d->title = $title;
$d->path = $pad->path;
$d->entry_id = $pad->entry_id;
$d->dir_id = $pad->dir_id;
$d->lister = $lister;
$d->authors = $authors;
return $d;

//EOF