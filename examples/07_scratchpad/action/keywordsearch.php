<?php
$this->request->term = filter_var($this->request->term, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_LOW);
$this->dispatch( dirname(__FILE__) . '/load');
$matches = $this->pad->keywordSearch($this->request->term);
$this->list = $this->instance( array('ids'=>array_keys( $matches ) ) );
$this->dispatch( dirname(__FILE__) . '/list');
$this->list->matches = $this->instance( $matches );
$this->list->pagination_url = $this->list->pagination_url .'&term=' . urlencode($this->request->term);


//EOF