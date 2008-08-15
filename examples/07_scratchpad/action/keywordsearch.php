<?php

$this->dispatch( dirname(__FILE__) . '/display');
$matches = $this->pad->keywordSearch($this->request->term);
$this->list = $this->instance( array('ids'=>array_keys( $matches ) ) );
$this->dispatch( dirname(__FILE__) . '/list');
$this->list->matches = $this->instance( $matches );

//EOF