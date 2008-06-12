<?
chdir( dirname(__FILE__)  );
include '../grok.php';

class Grok_InteractiveCLI_Main_Test extends Snap_UnitTestCase {
    
    protected $output;
    
    public function setup() {
        $file_pointer = fopen('stdin.mock.txt', 'r');
        ob_start();
        Grok::instance(array('STDIN'=>$file_pointer))->dispatch('../app/main.php' );
        $this->output = ob_get_clean();
        fclose( $file_pointer );
    }
    
    public function tearDown() {
        unset( $this->output );
    }
    
    public function test_OutputSays_Hello(){
        return $this->assertRegex( $this->output, '/hello/i');
    }
    
    public function test_OutputSays_Help(){
        return $this->assertRegex( $this->output, '/help/i');
    }
    
    public function test_OutputSays_GoodBye(){
        return $this->assertRegex( $this->output, '/good bye/i');
    }
    
    public function test_OutputSays_Error(){
        return $this->assertRegex( $this->output, '/error/i');
    }
    
    public function test_OutputSays_GrokException(){
        return $this->assertRegex( $this->output, '/grok_exception/i');
    }
    
    public function test_OutputSays_Prompt(){
        return $this->assertTrue( strpos( $this->output, '>') !== FALSE);
    }
    
    
    
}