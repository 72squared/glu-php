<?php

ob_start();
try {
    $this->dispatch($this->DIR_ROOT . 'route/enabled/' . $this->route );
} catch( Exception $e ){
    $this->exception = $e;
    $this->debug = ob_get_clean();
    ob_start();
    $this->dispatch($this->DIR_ROOT . 'route/available/error');
}
ob_end_flush();