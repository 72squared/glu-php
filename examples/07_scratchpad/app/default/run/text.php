<?
$this->dispatch($this->DIR_ACTION . 'display');
header('Content-Type: text/plain');
echo $this->pad->body;

// EOF