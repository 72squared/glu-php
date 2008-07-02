<?php
// include the grok
include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'grok.php';

class Grok_HtmlTemplate_Main_Test extends Snap_UnitTestCase {

    protected $result;
    protected $exception;
    protected $exception_message;
    
    public function setup() {
        try {
            ob_start();
            Grok::instance()->dispatch(dirname(dirname(__FILE__)) . '/lib/main.php');
            $this->output = trim( ob_get_contents() );
            ob_end_clean();
        } catch( Exception $e ){
            $this->exception = $e;
            $this->exception_message = $e->getMessage();
        }
    }
    
    public function tearDown() {
        unset( $this->output );
        unset( $this->exception );
        unset( $this->exception_message );
    }
    
    public function test_Output_StartsWithOpeningHTMLTag(){
        return $this->assertEqual( substr( $this->output, 0, 6), '<html>');
    }
    
    public function test_Output_EndsWithClosingHTMLTag(){
        return $this->assertEqual( substr( $this->output, -7), '</html>');
    }
    
    public function test_Output_hasTPLTitle(){
        return $this->assertRegex($this->output, '#<title>TPL</title>#i');
    }
    
    public function test_Output_hasH1(){
        return $this->assertRegex($this->output, '#<h1>template example</h1>#i');
    }
    
    public function test_Output_hasPTag(){
        return $this->assertRegex($this->output, '#<p>shows how to build a templating system</p>#i');
    }
    
    public function test_noExceptionThrown(){
        return $this->assertNull( $this->exception );
    }
}

// EOF