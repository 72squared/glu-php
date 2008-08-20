<?php
$path = $this->request->entry_id ? $this->request->entry_id : $this->path;
if( ! $path ) throw new Exception('invalid-path');
$this->pad = $this->NEW->ScratchPad( $path );
$this->author =  $this->NEW->User( $this->pad->author );
if( ! $this->permission instanceof Permission ) return;
if( ! $this->action ) return;
$result = $this->permission->verify( $this->action, $this->pad->path );
if( ! $result ) throw $this->exception('no-auth:' . $this->action . ' ' . $this->permission);
// EOF