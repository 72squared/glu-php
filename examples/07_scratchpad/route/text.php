<?
try {
    $this->dispatch($this->DIR_ROOT . 'action/display');
} catch( Exception $e ){
    $this->dispatch( $this->DIR_APP . 'run/pagenotfound');
    return;
}
header('Content-Type: text/plain');
echo $this->pad->body;

// EOF