<?php
$this->request->term = filter_var($this->request->term, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_LOW);
$this->dispatch( $this->dir->ACTION . 'load');
$this->list = $this->instance( array('ids'=>$this->pad->titleSearch($this->request->term)) );
$this->dispatch( $this->dir->ACTION . 'list');
$this->list->pagination_url = $this->list->pagination_url .'&term=' . urlencode($this->request->term);
//EOF