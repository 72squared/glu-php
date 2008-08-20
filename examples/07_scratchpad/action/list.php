<?php

$list = ( $this->list instanceof self ) ? $this->list : $this->instance();
if( ! is_array( $list->ids ) ) $list->ids = array();
if( ! $list->page && $this->request->page ){
    $list->page = abs( intval( $this->request->page ) );
}
if( $list->page < 1 ) $list->page = 1;
if( $list->per_page < 1 ) $list->per_page = 20;
$list->iterator = $this->Scratchpad_Lister( array_slice($list->ids,  ( $list->page - 1 ) * $list->per_page, $list->per_page) );
$authors = array();
foreach($list->iterator as $p ){
    if( ! $p->author ) continue;
    $authors[ $p->author ] = 1;
}
$list->authors = User::fetch( array_keys($authors) );
$list->count = count( $list->ids );
$list->total_pages = 1;

if( $list->count > $list->per_page ){
    $list->total_pages = ceil( $list->count / $list->per_page );
}

$list->pagination_url = $this->baseurl . $this->path . '?route=' . $this->route . '&page=#PAGE#';
$this->list = $list;

// EOF