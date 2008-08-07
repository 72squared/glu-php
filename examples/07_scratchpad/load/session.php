<?php
$key = '_' . md5(__FILE__);
if( $this->$key instanceof Session ) return $this->$key;
return $this->$key = new Session( $this->dispatch(ROOT_DIR . 'load/session_token') );
// EOF