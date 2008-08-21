<?php

ob_start();

$this->dispatch( $this->dir->ROOT . 'route/initialize');

try {
    $this->dispatch( $this->dir->ROOT . 'route/enabled/' . $this->route );
} catch( Exception $e ){
    $this->exception = $e;
    $this->debug = ob_get_clean();
    ob_start();
    $this->dispatch($this->dir->ROOT . 'route/available/error');
}
ob_end_flush();