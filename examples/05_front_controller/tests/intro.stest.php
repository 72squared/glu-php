<?
//find the current dir
$cwd = dirname(__FILE__);chdir( dirname(__FILE__)  );
include 'base.php';

class Grok_FrontEndController_Intro_Test extends Grok_FrontEndController_Test {
    public function setup(){
        $this->route = 'intro';
        parent::setup();
    }
    
    public function test_IsHtml(){
        return $this->assertRegex($this->output, '/<html>/' );
    }
        
    public function test_TitleSaysIntroduction(){
        $title = $this->dom->getElementsByTagName('title')->item(0)->nodeValue;
        return $this->assertRegex($title, '/Introduction/i' );
    }
    
    public function test_TitleSaysGrokApp(){
        $title = $this->dom->getElementsByTagName('title')->item(0)->nodeValue;
        return $this->assertRegex($title, '/grok app/i' );
    }
    
    public function test_h1SaysFrontEnd(){
        $title = $this->dom->getElementsByTagName('h1')->item(0)->nodeValue;
        return $this->assertRegex($title, '/front-end/i' );
    }
    
    public function test_h2SaysWelcome(){
        $title = $this->dom->getElementsByTagName('h2')->item(0)->nodeValue;
        return $this->assertRegex($title, '/Welcome to Grok/i' );
    }
    
    public function test_Output_Says_DemoMessage(){
        $pos = strpos( $this->output, 'This illustrates the basics');
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
    
    public function test_navLink_AjaxDemo(){
        $pattern = "#<a href=\"((?:\\/[\\w\\.]+)+)\\/ajaxdemo\">Ajax Demo<\\/a>#";
        return $this->assertRegex( $this->output, $pattern );
    }
}