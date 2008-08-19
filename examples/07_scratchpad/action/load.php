<?php
$path = $this->request->entry_id ? $this->request->entry_id : $this->path;
if( ! $path ) throw new Exception('invalid-path');
$this->pad = $this->ScratchPad( $path );
$this->author =  $this->User( $this->pad->author );
if( ! $this->acl_actions instanceof Grok ) return;
if( ! $this->user instanceof User ) return;
if( ! $this->route ) return;
if( ! $this->pad->area ) return;
$action = $this->acl_actions->{$this->route };
if( ! $action ) return;
$acl = $this->ACL( $this->pad->area );
$result = $acl->verify($this->user, $action );
if( ! $result ) throw $this->exception('no-auth');
// EOF