<?
chdir( dirname(__FILE__)  );

include '../class/__autoload.php';

class Grok_FrontendController_Test extends Snap_UnitTestCase {
    
    protected $start;
    protected $view;
    protected $input;
    protected $output;
    protected $dom;
    
    public function setup() {
        $vars = array('route'=>$this->route, 'start'=>$this->start = microtime(TRUE), 'request'=>$this->input);
        ob_start();
        Grok::instance( $vars )->dispatch('../app/main.php');
        $this->output = trim(ob_get_clean());
        $this->dom = new DOMDocument();
        $this->dom->loadHTML( $this->output );
    }
    
    public function teardown() {
        unset( $this->start );
        unset( $this->route );
        unset( $this->input );
        unset( $this->output );
        unset( $this->dom );
    }
}

// EOF