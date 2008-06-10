<?
chdir( dirname(__FILE__)  );
include 'base.php';

class Grok_ViewFirstController_HelloWorld_Test extends Grok_ViewFirstController_Test {
    public function setup(){
        $this->view = 'helloworld';
        parent::setup();
    }
    
    public function test_IsHtml(){
        return $this->assertRegex($this->output, '/<html>/' );
    }
        
    public function test_TitleSaysHello(){
        $title = $this->dom->getElementsByTagName('title')->item(0)->nodeValue;
        return $this->assertRegex($title, '/Hello, World/i' );
    }
    
    public function test_TitleSaysGrokApp(){
        $title = $this->dom->getElementsByTagName('title')->item(0)->nodeValue;
        return $this->assertRegex($title, '/grok app/i' );
    }
    
    public function test_h1SaysViewFirst(){
        $title = $this->dom->getElementsByTagName('h1')->item(0)->nodeValue;
        return $this->assertRegex($title, '/view-first/i' );
    }
    
    public function test_h2SaysHello(){
        $title = $this->dom->getElementsByTagName('h2')->item(0)->nodeValue;
        return $this->assertRegex($title, '/Hello, World!/i' );
    }
    
    public function test_Output_Says_EnterName(){
        $pos = strpos( $this->output, 'Enter your name below');
        return $this->assertTrue( $pos !== FALSE );
    }
    
    public function test_Page_Generated_In_Message(){
        $pattern = '/page generated in ([+-]?\\d*\\.\\d+)(?![-+0-9\\.]) seconds/i';
        return $this->assertRegex( $this->output, $pattern );
    }
    
    public function test_navLink_Home(){
        $pattern = "#<a href=\"((?:\\/[\\w\\.]+)+)\\/index\">Home<\\/a>#";
        return $this->assertRegex( $this->output, $pattern );
    }
    
    public function test_navLink_helloWorld(){
        $pattern = "#<a href=\"((?:\\/[\\w\\.]+)+)\\/helloworld\">Hello World<\\/a>#";
        return $this->assertRegex( $this->output, $pattern );
    }

    public function test_navLink_Intro(){
        $pattern = "#<a href=\"((?:\\/[\\w\\.]+)+)\\/intro\">Introduction<\\/a>#";
        return $this->assertRegex( $this->output, $pattern );
    }
    
    public function test_formIsPresent(){
        $obj = $this->dom->getElementsByTagName('form');
        return $this->assertIsA( $obj, 'DOMNodeList');
    }
}