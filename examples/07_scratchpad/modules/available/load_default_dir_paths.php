<?php
$dir = $this->NEW->Grok();
$dir->ROOT = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;
$dir->ACTION = $dir->ROOT . 'action' . DIRECTORY_SEPARATOR;
$dir->HTPASSWD = $dir->ROOT . 'htpasswd' . DIRECTORY_SEPARATOR;
$dir->ROUTE = $dir->ROOT . 'route' . DIRECTORY_SEPARATOR . 'enabled' . DIRECTORY_SEPARATOR;
$dir->STATIC = $dir->ROOT . 'static' . DIRECTORY_SEPARATOR;
$dir->TPL = $dir->ROOT . 'tpl' . DIRECTORY_SEPARATOR;
$dir->VIEW = $dir->ROOT . 'view' . DIRECTORY_SEPARATOR;

$this->dir = $dir;