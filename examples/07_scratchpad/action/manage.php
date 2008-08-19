<?php
$this->dispatch( $this->DIR_ACTION . 'display');
$this->acl = $acl = $this->ACL( $this->pad->area );
if( ! is_array($this->request->roles ) || ! is_array($this->request->actions ) ) return;
foreach( $acl->keys() as $k ) unset($acl->$k);
$actions = $this->instance( $this->request->actions );
$roles = $this->instance( $this->request->roles );

foreach( $roles as $i=>$role ){
    $a = $this->instance ($actions->$i )->keys();
    if( ( $a ) < 1 ) continue;
    $acl->$role = $a;
}
$acl->store();
// EOF