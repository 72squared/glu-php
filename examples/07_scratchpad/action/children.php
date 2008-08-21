<?php
$this->dispatch( $this->dir->ACTION . 'load');
$this->list = $this->instance( array('ids'=>$this->pad->children()) );
$this->dispatch( $this->dir->ACTION . 'list');
//EOF