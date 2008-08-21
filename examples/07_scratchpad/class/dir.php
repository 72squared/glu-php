<?
class dir extends Grok {
    public function __construct( $data = NULL ){
        parent::__construct( $data );
        $this->ROOT = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
        $this->ACTION = $this->ROOT . 'action' . DIRECTORY_SEPARATOR;
        $this->HTPASSWD = $this->ROOT . 'htpasswd' . DIRECTORY_SEPARATOR;
        $this->ROUTE = $this->ROOT . 'route' . DIRECTORY_SEPARATOR . 'enabled' . DIRECTORY_SEPARATOR;
        $this->STATIC = $this->ROOT . 'static' . DIRECTORY_SEPARATOR;
        $this->TPL = $this->ROOT . 'tpl' . DIRECTORY_SEPARATOR;
        $this->VIEW = $this->ROOT . 'view' . DIRECTORY_SEPARATOR;
    }
}