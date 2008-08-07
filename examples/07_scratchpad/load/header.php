<?php
$key = '_' . md5(__FILE__);
if( $this->$key instanceof Grok ) return $this->$key;
return $this->$key = $this->instance(array('title'=>'Welcome'));

// EOF