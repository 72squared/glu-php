<?php
$this->dispatch( dirname(__FILE__) . '/load');
$this->permission_lister = $this->Permission_Lister();
if( ! is_array($this->request->roles ) ) return;
$actions = $this->instance( $this->request->actions );
$roles = $this->instance( $this->request->roles );
$l = $this->permission_lister;
$path = $this->pad->path;
foreach( $roles as $i=>$role ){
    if( strlen( $role ) < 1 ) continue;
    $a = $this->instance( $actions->$i )->keys();
    $p = $l->{$role};
    if( ! $p ) $p = $l->{$role} = $this->Permission($role, array());
    $p->{$path} = $a;
    if( $p->count() < 1 ) unset( $l->{$role} );
    $p->store();
}
// EOF