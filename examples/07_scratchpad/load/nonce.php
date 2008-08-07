<?php
$key = '_' . md5(__FILE__);
if( $this->$key instanceof Nonce ) return $this->$key;
$secret = $this->dispatch( ROOT_DIR . 'load/secret');
$key = $this->dispatch( ROOT_DIR . 'load/scratchpad')->entry_id;
return $this->$key = new Nonce( md5( $secret . $key ) );

// EOF