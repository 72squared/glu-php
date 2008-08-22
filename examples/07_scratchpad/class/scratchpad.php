<?php

class Scratchpad extends Grok {


    protected static $db;
    
    
    const ARTICLE = 0;
    const COMMENT = 1;
    const IMAGE = 2;

    
    public function __construct( $data = NULL ){
        if( $data === NULL ) return;
         if( is_scalar($data) ){
            if( preg_match("#^[0-9]+$#", $data ) ){
                $this->entry_id = $data;
            } elseif(preg_match('#^/[0-9]+$#', $data)){
                $this->entry_id = substr($data, 1);
            } else {
                $this->path = $data;
            }
        } else {
            parent::__construct($data);
        }
        
        try {
            $this->load();
        } catch( PDOException $e ){
            $msg =  $e->getMessage();
            if( strpos($e, 'no such table') === FALSE ) throw $e;
            $this->initialize();
            $this->load();
        }
    }
    
    protected function load(){
        $this->loadEntry();
        $this->loadDirectoryByID();
        $this->loadDirectoryByPath();
        $this->loadEntry();
    }
    
    protected function __set( $k, $v ){
        switch( $k ){
            case 'dir_id':          $v = intval($v);
                                    if( $v < 1 ) return NULL;
                                    break;
                                    
            case 'path':            $v = '/' . trim(strval($v), ' /-_');
                                    if( ! preg_match('#^[\/][a-z0-9\/\_\-\.]?+$#i', $v) ) return NULL;
                                    break;
                                    
            case 'parent':          $v = intval($v);
                                    if( $v < 0 ) return NULL;
                                    break;
                                    
            case 'entry_id':        $v = intval($v);
                                    if( $v < 1 ) return NULL;
                                    break;
                                    
            case 'entry_type':      $v = intval($v);
                                    if( $v < 0 ) return NULL;
                                    break;
                                    
            case 'author':          $v = intval($v);
                                    if( $v < 1 ) return NULL;
                                    break;
                                    
            case 'created':         $v = strval($v);
                                    if( preg_match("/^[0-9]+$/", $v)) $v = date('Y/m/d H:i:s', $v);
                                    $v = strtotime( $v );
                                    if( ! $v ) return NULL;
                                    break;
                                    
            case 'body':            $v = strval($v);
                                    break;
            
            default :               if( ! preg_match('#[a-z][a-z0-9_]+$#', $k) ) return NULL;
                                    break;
        }
        
        return parent::__set($k, $v);
    }
    
    protected function __get( $k ){
        return ( $k == 'title' ) ? self::pathToName( $this->path ) : parent::__get($k);
    }
    
    public static function pathToName( $path ){
         $title = ucwords(trim(str_replace( array('/', '-', '_'), ' ', $path)));
        if( ! $title ) $title = 'Home';
        return $title;
    }
    
    public function ancestry(){
        $paths = array();
        foreach( $this->extractPaths()  as $path ){
            $paths[ $path ] = NULL;
        }
        if( $this->dir_id !== NULL ){
            $paths[ $this->path ] = $this->dir_id;
        }
        
        if( $this->parent !== NULL ){
            $paths[ substr($this->path, 0, strrpos($this->path, '/') ) ] = $this->parent;
        }
        
        $clauses = array_keys($paths, NULL);
        if( count( $clauses ) < 1 ) return $paths;
        $sql = sprintf( "SELECT dir_id, path FROM directory WHERE path IN( %s )", implode(', ', array_fill(0, count($clauses), '?')));
        $db = $this->db();
        $st = $db->prepare($sql);
        $st->execute( $clauses );
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $paths[$row['path']] = $row['dir_id'];
        $st->closeCursor();
        return $paths;
    }
    
    public function children(){
        $db = $this->db();
        $st = $db->prepare("SELECT entry_id, path FROM directory WHERE parent = ? AND entry_type = 0");
        $st->execute(array($this->dir_id));
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $paths[ $row['path'] ] = $row['entry_id'];
        $st->closeCursor();
        return $paths;
    }
    
    public function descendents(){
        $db = $this->db();
        $st = $db->prepare("SELECT dir_id, entry_id, path FROM directory WHERE path >= ? AND path <= ?");
        $st->execute(array($this->path, $path . 'z'));
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ){
            if( $row['dir_id'] == $this->dir_id ) continue;
            $paths[ $row['path'] ] = $row['entry_id'];
        }
        $st->closeCursor();
        return $paths;
    }
    
    public function titleSearch( $term = '' ){
        $counter = new Keyword_Counter( $term );
        $words = $counter->keys();
        if( count( $words ) < 1 ) return array();
        $clauses = array($this->path, $this->path . 'z');
        foreach( $words as $word ) $clauses[] = '%' . $word . '%';
        $sql = "SELECT entry_id, path FROM directory WHERE path >= ? AND path <= ? AND " . implode(' AND ', array_fill(0, count($words), 'path LIKE ?'));
        var_dump( $sql );
        $db = $this->db();
        $st = $db->prepare($sql);
        $st->execute( $clauses );
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $paths[ $row['path'] ] = $row['entry_id'];
        }
        $st->closeCursor();
        return $paths;
    }
    
    public function recent(){
        $db = $this->db();
        $st = $db->prepare("SELECT d.entry_id, d.path FROM directory d INNER JOIN entry e ON d.entry_id = e.entry_id WHERE d.path >= ? AND d.path <= ? ORDER BY e.created DESC");
        $st->execute(array($this->path, $this->path . 'z'));
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $paths[ $row['d.path'] ] = $row['d.entry_id'];
        }
        $st->closeCursor();
        return $paths;
    }
    
    public function keywordSearch( $term = '' ){
        $search = array();
        $counter = new Keyword_Counter($term);
        foreach( $counter->keys() as $word ) $search[] = $word . '%';
        if( count( $search ) < 1 ) return array();
        $sql = 'SELECT word_checksum FROM keywords WHERE ' . implode(' OR ', array_fill(0, count($search), 'word LIKE ?'));
        $db = $this->db();
        $st = $db->prepare( $sql );
        $st->execute($search);
        $checksums = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ){
            $checksums[] = $row['word_checksum'];
        }
        $st->closeCursor();
        if( count( $checksums ) < 1 ) return array();
        $clauses = array($this->path, $this->path . 'z');
        foreach( $checksums as $checksum ) {
            $clauses[] = $checksum;
        }
        
        $sql = "SELECT d.entry_id, SUM(k.counter) as ct FROM directory d INNER JOIN " .
                "entry e ON d.entry_id = e.entry_id INNER JOIN " .
                "entry_keywords k ON e.entry_id = k.entry_id " . 
                "WHERE d.path >= ? AND d.path <= ? AND k.word_checksum IN( %s ) " . 
                "GROUP BY d.entry_id " . 
                "ORDER BY ct DESC";
        
        $sql = sprintf( $sql, implode(', ', array_fill(0, count($checksums), '?')));
        $st = $db->prepare($sql);
        $st->execute( $clauses );
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $paths[ $row['d.entry_id'] ] = $row['ct'];
        }
        $st->closeCursor();
        return $paths;
    }
    
    public function batch($entry_ids){
        $iterator = new Scratchpad_Lister;
        if( ! is_array($entry_ids) || count($entry_ids) < 1 ) return $iterator;
        $clean_ids = $entries = $dir_ids = array();
        foreach($entry_ids as $path=>$id ) {
            $entries[ $id ] = array();
            $id = intval($id );
            if( $id < 1 ) continue;
            $clean_ids[] = $id;
        }
        if( count($clean_ids ) < 1 ) return $iterator;
        $db = $this->db();
        $st = $db->query(sprintf("SELECT * FROM entry WHERE entry_id IN( %s ) ORDER BY entry_id DESC", implode(',', $clean_ids) ) );
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $entries[$row['entry_id']] = $row;
            $dir_ids[ $row['dir_id']] = 1;
        }
        $st->closeCursor();
        if( count($entries) < 1 ) return $iterator;
        $st = $db->query(sprintf("SELECT dir_id, path FROM directory WHERE dir_id IN ( %s )", implode(', ', array_keys($dir_ids))));
        $dirs = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $dirs[$row['dir_id']] = $row;
        }
        $st->closeCursor();
        foreach($entries as $key=>$entry){
            if( ! isset( $dirs[ $entry['dir_id'] ]) ) continue;
            foreach( $dirs[ $entry['dir_id'] ] as $k=>$v) $entry[$k] = $v;
            $iterator->$key = new Scratchpad($entry);
        }
        return $iterator;
    }
    
    public function loadEntry(){
        if(! isset( $this->entry_id )) return;
        if( isset( $this->body ) && isset( $this->author) && isset( $this->created)) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM entry WHERE entry_id = ?");
        $st->execute(array($this->entry_id));
        if( ! $data = $st->fetch(PDO::FETCH_ASSOC) ) {
            unset( $this->entry_id );
            return;
        }
        $st->closeCursor();
        $this->loadData($data);
    }
    
    public function loadDirectoryByPath(){
        if( ! isset( $this->path ) ) return;
        if( isset( $this->dir_id ) && isset( $this->entry_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM directory WHERE path = ?");
        $st->execute(array($this->path));
        if( ! $data = $st->fetch(PDO::FETCH_ASSOC) ) return;
        $st->closeCursor();
        if( $this->entry_type > self::ARTICLE ) unset( $data['entry_id']);
        $this->loadData($data);
    }
    
    public function loadDirectoryByID(){
        if( ! isset( $this->dir_id ) ) return;
        if( isset( $this->path ) && isset( $this->entry_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM directory WHERE dir_id = ?");
        $st->execute(array($this->dir_id));
        if( ! $data = $st->fetch(PDO::FETCH_ASSOC) ) return;
        $st->closeCursor();
        if( $this->entry_type > self::ARTICLE ) unset( $data['entry_id']);
        $this->loadData($data);
    }
    
    public function comments(){
        $db = $this->db();
        $st = $db->prepare("SELECT entry_id FROM entry WHERE dir_id = ? AND entry_type = 1 ORDER BY entry_id DESC");
        $st->execute(array($this->dir_id));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function history(){
        $db = $this->db();
        $st = $db->prepare("SELECT entry_id FROM entry WHERE dir_id = ? AND entry_type = 0 ORDER BY entry_id DESC");
        $st->execute(array($this->dir_id));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function descendentsHistory(){
        $db = $this->db();
        $st = $db->prepare("SELECT e.entry_id FROM directory d INNER JOIN entry e ON d.dir_id = e.dir_id AND e.entry_type = 0 WHERE d.path >= ? AND d.path <= ? ORDER BY e.entry_id DESC");
        $st->execute(array($this->path, $this->path . 'z'));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['entry.entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function childrenHistory(){
        $db = $this->db();
        $st = $db->prepare("SELECT e.entry_id FROM directory d INNER JOIN entry e ON d.dir_id = e.dir_id AND e.entry_type = 0 WHERE d.parent = ? ORDER BY e.entry_id DESC");
        $st->execute(array($this->dir_id));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['e.entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function store(){
        if( ! isset( $this->path ) ) return;
        if( ! $this->dir_id ) $this->initializePaths();
        $params = array();
        $params['dir_id'] = $this->dir_id;
        $params['entry_type'] = $this->entry_type = intval($this->entry_type);
        $params['author'] = $this->author;
        $params['created'] = $this->created = $this->now();
        $params['body'] = $this->body;
        $data = array();
        foreach($this as $k=>$v){
            if( in_array($k, array('dir_id', 'path', 'parent', 'entry_id', 'entry_type', 'author', 'created', 'body') ) ) continue;
            $data[$k] = $v;
        }
        $params['data'] = $this->encode($data);
        $db = $this->db();
        $st = $db->prepare( "INSERT INTO entry (dir_id, entry_type, author, created, body, data) VALUES (:dir_id, :entry_type, :author, :created, :body, :data)");
        $st->execute( $params );
        $this->entry_id = $db->lastInsertId();
        // if this is not a typical entry, don't write to the directory.
        if( $this->entry_type ) return;
        
        $st = $db->prepare("UPDATE directory SET entry_id = :entry_id WHERE dir_id = :dir_id");
        $st->execute(array('entry_id'=>$this->entry_id, 'dir_id'=>$this->dir_id) );
        
        $search_string = $this->title;
        foreach( $this as $k=>$v ){
            if( $k=='body' && $this->image )continue;
            $search_string .= ' ' . $v;
        }
        $word_counter = new Keyword_Counter( $search_string );
        
        $word_map = array();
        foreach( $word_counter->keys() as $word ){
            $word_map[ $this->crc( $word ) ] = $word;
        }
        if( count( $word_map ) > 0 ){
            $sql = sprintf( "SELECT word_checksum FROM keywords WHERE word_checksum IN(%s)", implode(', ', array_fill(0, count($word_map), '?') ));
            $st = $db->prepare($sql);
            $st->execute(array_keys($word_map));
            while( $row = $st->fetch(PDO::FETCH_ASSOC) ){
                if( isset( $word_map[ $row['word_checksum'] ] ) ) unset( $word_map[ $row['word_checksum'] ] );
            }
            $st->closeCursor();
        }
        
        if( count( $word_map ) > 0 ){
            $st = $db->prepare('INSERT INTO keywords (word_checksum, word) VALUES (:word_checksum, :word)');
            foreach( $word_map as $word_checksum=>$word ){
                $st->execute(array('word_checksum'=>$word_checksum, 'word'=>$word));
            }
        }
        
        $st = $db->prepare("INSERT INTO entry_keywords (entry_id, word_checksum, counter) VALUES (:entry_id, :word_checksum, :counter)");
        foreach( $word_counter as $word=>$counter ){
            $st->execute(array('entry_id'=>$this->entry_id, 'word_checksum'=>$this->crc($word), 'counter'=>$counter ));
        }
    }
    
    public function initialize(){
        $db = $this->db();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $file = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'schema' . DIRECTORY_SEPARATOR . 'scratchpad.sql';
        $queries = explode(";\n", file_get_contents($file));
        foreach( $queries as $sql ) $db->query( $sql );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/
   
    protected function initializePaths(){
        $paths = $this->ancestry();
        $db = $this->db();
        $st = $db->prepare("INSERT INTO directory (path, parent) VALUES (:path, :parent)");
        $parent = $this->parent = 0;
        foreach( $paths as $path=>$dir_id ){
            if( $dir_id === NULL ){
                $st->execute(array('path'=>$path, 'parent'=>$parent));
                $dir_id = $paths[ $path ] = $db->lastInsertId();
            }
            $this->parent = $parent;
            $parent = $this->dir_id = $dir_id;
        }
        return $paths;
    }
    
    public function extractPaths(){
        $paths = array();
        foreach( explode('/', $this->path) as $dir ){
            $path .= '/' . $dir;
            $path = '/' . trim($path, '/');
            $paths[$path] = 1;
        }
        return array_keys($paths);
    }
    
    protected function loadData( $data ){
        if( ! is_array( $data ) ) return;
        $extra = $this->decode( $data['data']);
        unset( $data['data']);
        foreach( $data as $k=>$v) {
            if( ! isset( $this->$k ) ) $this->$k = $v;
        }
        foreach( $extra as $k=>$v) {
            if( ! isset( $this->$k ) ) $this->$k = $v;
        }
    }
    
    protected function encode($v){
        if( ! is_array( $v ) ) $v = array();
        if( empty( $v ) ) return '';
        return @json_encode($v);
    }
    
    protected function decode($v){
        $v = json_decode($v);
        if( ! is_array( $v ) && ! ($v instanceof stdclass) ) $v = array();
        return $v;
    }
    
    protected function db(){
        if( isset( self::$db ) ) return self::$db;
        $path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . 'scratchpad.db';
        $db = new PDO('sqlite2:' . $path, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
    
    protected function crc($str){
        return crc32($str);
    }
    
    protected function now(){
        return time();
    }
}

// EOF