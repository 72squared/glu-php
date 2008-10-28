<?
class MarkdownCompletePath {

    protected $path = '';
    
    public function __construct( $complete_path ){
        $this->path = $complete_path;
    }
    
    public function add($text){
        //return $text;
        $text = preg_replace('#(\[[\w\s]+\]:[\s])([\w\d:\#@%/;$()~_?\+-=\\\.&]+)#', 
                                 "$1" . $this->path . "$2", $text);
                                 
        $text = preg_replace('#(\[[\w\s]+\]?[\s]\()([\w\d:\#@%/;$()~_?\+-=\\\.&]+)(([\s]\"[\w]+\")?\))#', 
                                 "$1" . $this->path . "$2$3", $text);
        return $text;
    }
    
    public function remove($text){
        
    }
}

