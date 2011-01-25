<?
class dir extends GLU {
    public function __construct( $data = NULL ){
        parent::__construct( $data );
        $this->ROOT = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
        $this->ACTION = $this->ROOT . 'action' . DIRECTORY_SEPARATOR;
        $this->SECRET = $this->ROOT . 'secret' . DIRECTORY_SEPARATOR;
        $this->ROUTE = $this->ROOT . 'route' . DIRECTORY_SEPARATOR . 'enabled' . DIRECTORY_SEPARATOR;
        $this->STATIC = $this->ROOT . 'static' . DIRECTORY_SEPARATOR;
        $this->VIEW = $this->ROOT . 'view' . DIRECTORY_SEPARATOR;
    }
}