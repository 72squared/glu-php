<?
$this->dispatch(ROOT_DIR . 'action/display');
header('Content-Type: text/plain');
echo $this->pad->body;

// EOF