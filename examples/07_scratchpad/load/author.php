<?
$key = '_' . md5(__FILE__);
if( $this->$key instanceof User ) return $this->$key;
return $this->$key = new User( $this->dispatch(ROOT_DIR . 'load/scratchpad')->author );
// EOF