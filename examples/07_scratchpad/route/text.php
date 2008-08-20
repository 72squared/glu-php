<?
try {
    $this->dispatch($this->DIR_ACTION . 'display');
} catch( Exception $e ){
    $this->dispatch( $this->DIR_ROUTE . 'pagenotfound');
    return;
}
header('Content-Type: text/plain');
echo $this->pad->body;

// EOF