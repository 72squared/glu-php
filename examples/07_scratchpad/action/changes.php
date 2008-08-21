<?php
$this->dispatch( $this->dir->ACTION . 'load');
$this->list = $this->instance( array('ids'=>$this->pad->descendentsHistory()) );
$this->dispatch( $this->dir->ACTION . 'list');
//EOF