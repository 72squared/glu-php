<?php
$list = ( $this->list instanceof self ) ? $this->list : $this->instance();
if( ! $list->page && $this->request->page ){
    $list->page = abs( intval( $this->request->page ) );
}
if( $list->page < 1 ) $list->page = 1;
if( $list->per_page < 1 ) $list->per_page = 20;

$start = ( $list->page - 1 ) * $list->per_page;
$lister = User::listing($start, $list->per_page);
$total = User::listingCount();

$list->iterator = $lister;
$list->count = $total;

$list->total_pages = 1;

if( $list->count > $list->per_page ){
    $list->total_pages = ceil( $list->count / $list->per_page );
}

$this->list = $list;
// EOF