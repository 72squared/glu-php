<?
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . '__autoload.php';

class Grok_ViewFirstController_Test extends Snap_UnitTestCase {
    
    protected $start;
    protected $view;
    protected $input;
    protected $output;
    protected $dom;
    
    public function setup() {
        $vars = array('view'=>$this->view, 'start'=>$this->start = microtime(TRUE), 'request'=>$this->input);
        ob_start();
        Grok::instance( $vars )->dispatch(dirname(dirname(__FILE__)) . '/app/main.php');
        $this->output = trim(ob_get_clean());
        $this->dom = new DOMDocument();
        $this->dom->loadHTML( $this->output );
    }
    
    public function teardown() {
        unset( $this->start );
        unset( $this->view );
        unset( $this->input );
        unset( $this->output );
        unset( $this->dom );
    }
}

// EOF