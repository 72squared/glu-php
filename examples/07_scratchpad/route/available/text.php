<?
try {
    $this->dispatch($this->dir->ACTION . 'display');
} catch( Exception $e ){
    $this->dispatch( $this->dir->ROUTE . 'pagenotfound');
    return;
}
header('Content-Type: text/plain');
echo $this->pad->body;

// EOF