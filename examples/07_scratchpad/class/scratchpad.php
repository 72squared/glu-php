<?php

class Scratchpad extends Grok {


    protected static $db;
    
    const filename = 'scratchpad.db';
    
    private $checksum = '';
    
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
        $this->loadEntry();
        $this->loadDirectoryByID();
        $this->loadDirectoryByPath();
        $this->loadEntry();
        $this->checksum = $this->checksum();
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/
    
    protected function __set( $k, $v ){
        switch( $k ){
            case 'dir_id':          $v = intval($v);
                                    if( $v < 1 ) return NULL;
                                    break;
                                    
            case 'path':            $v = '/' . trim(strval($v), ' /-_');
                                    if( ! preg_match('#^[\/]?[a-z0-9\/\_\-]+$#i', $v) ) return NULL;
                                    break;
                                    
            case 'parent':          $v = intval($v);
                                    if( $v < 0 ) return NULL;
                                    break;
                                    
            case 'entry_id':        $v = intval($v);
                                    if( $v < 1 ) return NULL;
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
        if( $k != 'title' ) return parent::__get($k);
        $title = ucwords(trim(str_replace( array('/', '-', '_'), ' ', $this->path)));
        if( ! $title ) $title = 'Home';
        return $title;
    }
    
    public function ancestry(){
        $clauses = $paths = array();
        foreach( $this->extractPaths()  as $path ){
            $clauses[ $path ] = "'" . $path . "'";
            $paths[ $path ] = NULL;
        }
        if( $this->dir_id ){
            $paths[ $this->path ] = $this->dir_id;
            unset( $clauses[ $this->path ] );
        }
        
        if( count( $clauses ) < 1 ) return $paths;
        
        $sql = sprintf( "SELECT dir_id, path FROM directory WHERE path IN( %s )", implode(', ', $clauses));
        
        $db = $this->db();
        $st = $db->query($sql);
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $paths[$row['path']] = $row['dir_id'];
        $st->closeCursor();
        return $paths;
    }
    
    public function children(){
        $db = $this->db();
        $st = $db->prepare("SELECT entry_id, path FROM directory WHERE parent = ?");
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
    
    public function find( $term = '' ){
        $clauses = array( sprintf("path >= '%s' AND path <= '%s'", $this->path, $this->path . 'z') );
        foreach( explode(' ', trim(preg_replace('/[^a-z0-9 ]/i', '', $term))) as $term ){
            $term = trim($term);
            if( strlen( $term ) < 1 ) continue;
            $clauses[] = sprintf("path LIKE '%s'",  '%' . $term . '%');
        }
        $sql = "SELECT entry_id, path FROM directory WHERE " . implode(' AND ', $clauses);
        $db = $this->db();
        $st = $db->query($sql);
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $paths[ $row['path'] ] = $row['entry_id'];
        }
        $st->closeCursor();
        return $paths;
    }
    
    
    public function search( $term = '' ){
        $clauses = array( sprintf("directory.path >= '%s' AND directory.path <= '%s'", $this->path, $this->path . 'z') );
        foreach( explode(' ', trim(preg_replace('/[^a-z0-9 ]/i', '', $term))) as $term ){
            $term = trim($term);
            if( strlen( $term ) < 1 ) continue;
            $clauses[] = sprintf("entry.body LIKE '%s'",  '%' . $term . '%');
        }
        $sql = "SELECT directory.entry_id, directory.path FROM directory INNER JOIN entry ON directory.entry_id = entry.entry_id WHERE " . implode(' AND ', $clauses);
        $db = $this->db();
        $st = $db->query($sql);
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $paths[ $row['directory.path'] ] = $row['directory.entry_id'];
        }
        $st->closeCursor();
        return $paths;
    }
    
    public function batch(Scratchpad_Lister $iterator, $entry_ids){
        if( ! is_array($entry_ids) || count($entry_ids) < 1 ) return $iterator;
        $clean_ids = array();
        foreach($entry_ids as $path=>$id ) {
            $id = intval($id );
            if( $id < 1 ) continue;
            $clean_ids[] = $id;
        }
        if( count($clean_ids ) < 1 ) return $iterator;
        $db = $this->db();
        $st = $db->query(sprintf("SELECT * FROM entry WHERE entry_id IN( %s ) ORDER BY entry_id DESC", implode(',', $clean_ids) ) );
        $entries = $dir_ids = array();
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
        $this->loadData($data);
    }
    
    public function history(){
        $db = $this->db();
        $st = $db->prepare("SELECT entry_id FROM entry WHERE dir_id = ? ORDER BY dir_id DESC, entry_id DESC LIMIT 500");
        $st->execute(array($this->dir_id));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function descendentsHistory(){
        $db = $this->db();
        $st = $db->prepare("SELECT entry.entry_id FROM directory INNER JOIN entry ON directory.dir_id = entry.dir_id WHERE directory.path >= ? AND directory.path <= ? ORDER BY entry.entry_id DESC LIMIT 500");
        $st->execute(array($this->path, $this->path . 'z'));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['entry.entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function childrenHistory(){
        $db = $this->db();
        $st = $db->prepare("SELECT entry.entry_id  FROM directory INNER JOIN entry ON directory.dir_id = entry.dir_id WHERE directory.parent ? ORDER BY entry.entry_id DESC LIMIT 500");
        $st->execute(array($this->dir_id));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['entry.entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function checkAndStore(){
        if( $this->checksum == $this->checksum() ) return;
        $this->store();
    }
    
    public function store(){
        if( ! isset( $this->path ) ) return;
        if( ! $this->dir_id ) $this->initializePaths();
        $params = array();
        $params['dir_id'] = $this->dir_id;
        $params['author'] = $this->author;
        $params['created'] = $this->created = $this->now();
        $params['body'] = $this->body;
        $data = array();
        foreach($this as $k=>$v){
            if( in_array($k, array('dir_id', 'path', 'parent', 'entry_id', 'author', 'created', 'body') ) ) continue;
            $data[$k] = $v;
        }
        $params['data'] = $this->encode($data);
        $db = $this->db();
        $st = $db->prepare( "INSERT INTO entry (dir_id, author, created, body, data) VALUES (:dir_id, :author, :created, :body, :data)");
        $st->execute( $params );
        $this->entry_id = $db->lastInsertId();
        $st = $db->prepare("UPDATE directory SET entry_id = :entry_id WHERE dir_id = :dir_id");
        $st->execute(array('entry_id'=>$this->entry_id, 'dir_id'=>$this->dir_id) );
        $this->checksum = $this->checksum();
    }
    
    public function initialize(){
        $db = $this->db();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $db->query('DROP TABLE entry');
        $db->query('DROP TABLE directory');
        $db->query('CREATE TABLE entry ( entry_id  INTEGER PRIMARY KEY, dir_id INTEGER, author INTEGER, created INTEGER, body TEXT, data TEXT)');
        $db->query('CREATE TABLE directory (dir_id INTEGER PRIMARY KEY, parent INTEGER, path TEXT(500) UNIQUE, entry_id INTEGER UNIQUE)');
        $db->query('CREATE INDEX directory_entry_id ON directory(entry_id)');
        $db->query('CREATE INDEX directory_parent ON directory(parent)');
        $db->query('CREATE INDEX entry_dir_id ON entry(dir_id)');
        $db->query('CREATE INDEX entry_author ON entry(author)');
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
    
    protected function extractPaths(){
        $paths = array();
        foreach( explode('/', $this->path) as $dir ){
            $path .= '/' . $dir;
            $path = '/' . trim($path, '/');
            $paths[] = $path;
        }
        return $paths;
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
        $path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . self::filename;
        $db = new PDO('sqlite2:' . $path, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
    
    protected function checksum(){
        return md5(strval($this));
    }
    
    protected function now(){
        return time();
    }
}

// EOF