<?
$a  = $this->instance();

$a->changes = 'read';
$a->changes = 'read';
$a->children = 'read';
$a->descendents = 'read';
$a->display = 'read';
$a->edit = 'write';
$a->history = 'read';
$a->keywordsearch = 'read';
$a->list = 'read';
$a->manage = 'manage';
$a->recent = 'read';
$a->titlesearch = 'read';
$a->addcomment = 'comment';

$role = $user->role;
if( ! $role ){
    $role = ( $this->user->user_id ) ? 'user' : 'guest';
}
$overrides = NULL;

if( $this->user->user_id == 1 ){
    $overrides = array('/'=>array('read','write','comment', 'manage'));
}

$this->permission = $permission = $this->Permission( $role, $overrides );
$action = $a->{$this->route };
if( ! $action ) $action = 'read';
$this->action = $action;
$this->permission_map = $a;