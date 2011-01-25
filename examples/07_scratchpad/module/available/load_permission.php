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

$action = $a->{$this->route };
if( ! $action ) $action = 'read';
$this->action = $action;
$this->permission_map = $a;

$this->permission = $permission = $this->NEW->Permission( $this->user );
