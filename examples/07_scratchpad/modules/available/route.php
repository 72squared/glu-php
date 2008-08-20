<?php

ob_start();
try {
    $this->dispatch($this->DIR_ROOT . 'route/' . $this->route );
} catch( Exception $e ){
    $this->exception = $e;
    $this->debug = ob_get_clean();
    ob_start();
    $this->dispatch($this->DIR_ROOT . 'route/error');
}
ob_end_flush();