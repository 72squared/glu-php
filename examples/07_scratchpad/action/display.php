<?php
$this->dispatch( dirname(__FILE__) . '/load');
$this->list = $this->instance( array('ids'=>$this->pad->comments()) );
$this->dispatch( dirname(__FILE__) . '/list');

// EOF