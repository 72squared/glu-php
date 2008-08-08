<?php
$d = $this->instance();
$d->baseurl = $this->baseurl;
$session = $d->session = $this->Session();
$user = $d->user = $this->User( $session->user_id );
$pad = $this->ScratchPad( $this->path );

$title = 'Search';
$term = $this->term;

$titles = $this->Scratchpad_Lister( $pad->find( $term ) );
$keywords = $this->Scratchpad_Lister( $pad->search($term) );
$ids = array();

foreach( $titles as $s ){
    if( ! $pad->author ) continue;
    $ids[$pad->author] = 1;
}

foreach( $keywords as $s ){
    if( ! $pad->author ) continue;
    $ids[$pad->author] = 1;
}

$authors = $this->User_Lister( array_keys( $ids ) );

$d->title = $title;
$d->path = $pad->path;
$d->entry_id = $pad->entry_id;
$d->dir_id = $pad->dir_id;
$d->titles = $titles;
$d->keywords = $keywords;
$d->authors = $authors;

return $d;

//EOF



