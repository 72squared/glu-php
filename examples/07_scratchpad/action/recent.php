<?php
$this->dispatch( dirname(__FILE__) . '/display');
$this->list = $this->instance( array('ids'=>$this->pad->recent()) );
$this->dispatch( dirname(__FILE__) . '/list');

//EOF