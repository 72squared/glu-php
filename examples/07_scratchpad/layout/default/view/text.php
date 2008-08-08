<?
header('Content-Type: text/plain');
echo $this->dispatch(ROOT_DIR . 'action/text')->body;

// EOF