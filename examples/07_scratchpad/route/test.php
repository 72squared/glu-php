<?php
$permission = $this->Permission('user');
$permission->{'/'} = array('read','write','comment');
//$permission->{'/projects'} = array('read','write','comment');
//unset( $permission->{'/projects'} );
$permission->store();
var_dump( $permission );