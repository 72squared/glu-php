<?php
$this->dispatch( $this->dir->ACTION . 'load');
$this->list = $this->instance( array('ids'=>$this->pad->comments()) );
$this->dispatch( $this->dir->ACTION . 'list');

// EOF