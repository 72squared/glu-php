<?
class Scratchpad_Storage {

    protected static $db;
    
    const filename = 'scratchpad.db';
    
    public function load( Scratchpad $pad ){
        $this->loadEntry( $pad );
        $this->loadDirectoryByID( $pad );
        $this->loadDirectoryByPath( $pad );
        $this->loadEntry( $pad );
    }
    
    public function children( Scratchpad $pad ){
        $db = $this->db();
        $st = $db->prepare("SELECT entry_id, path FROM directory WHERE parent = ?");
        $st->execute(array($pad->dir_id));
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $paths[ $row['path'] ] = $row['entry_id'];
        $st->closeCursor();
        return $paths;
    }
    
    public function descendents( Scratchpad $pad ){
        $db = $this->db();
        $st = $db->prepare("SELECT dir_id, entry_id, path FROM directory WHERE path >= ? AND path <= ?");
        $st->execute(array($pad->path, $path . 'z'));
        $paths = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ){
            if( $row['dir_id'] == $pad->dir_id ) continue;
            $paths[ $row['path'] ] = $row['entry_id'];
        }
        $st->closeCursor();
        return $paths;
    }
    
    public function find( Scratchpad $pad, $term = '' ){
        $clauses = array( sprintf("path >= '%s' AND path <= '%s'", $pad->path, $pad->path . 'z') );
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
    
    
    public function search( Scratchpad $pad, $term = '' ){
        $clauses = array( sprintf("directory.path >= '%s' AND directory.path <= '%s'", $pad->path, $pad->path . 'z') );
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
    
    public function loadEntry( Scratchpad $pad ){
        if(! isset( $pad->entry_id )) return;
        if( isset( $pad->body ) && isset( $pad->author) && isset( $pad->created)) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM entry WHERE entry_id = ?");
        $st->execute(array($pad->entry_id));
        if( ! $data = $st->fetch(PDO::FETCH_ASSOC) ) {
            unset( $pad->entry_id );
            return;
        }
        $st->closeCursor();
        foreach( $data as $k=>$v ) $pad->$k = $v;
    }
    
    public function loadDirectoryByPath( Scratchpad $pad ){
        if( ! isset( $pad->path ) ) return;
        if( isset( $pad->dir_id ) && isset( $pad->entry_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM directory WHERE path = ?");
        $st->execute(array($pad->path));
        if( ! $data = $st->fetch(PDO::FETCH_ASSOC) ) return;
        $st->closeCursor();
        foreach( $data as $k=>$v ) {
            if( ! isset( $pad->$k ) ) $pad->$k = $v;
        }
    }
    
    public function loadDirectoryByID( Scratchpad $pad ){
        if( ! isset( $pad->dir_id ) ) return;
        if( isset( $pad->path ) && isset( $pad->entry_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM directory WHERE dir_id = ?");
        $st->execute(array($pad->dir_id));
        if( ! $data = $st->fetch(PDO::FETCH_ASSOC) ) return;
        $st->closeCursor();
        foreach( $data as $k=>$v ) {
            if( ! isset( $pad->$k ) ) $pad->$k = $v;
        }
    }
    
    public function history( $dir_id ){
        $db = $this->db();
        $st = $db->prepare("SELECT entry_id FROM entry WHERE dir_id = ? ORDER BY dir_id DESC, entry_id DESC LIMIT 500");
        $st->execute(array($dir_id));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function descendentsHistory( Scratchpad $pad ){
        $db = $this->db();
        $st = $db->prepare("SELECT entry.entry_id FROM directory INNER JOIN entry ON directory.dir_id = entry.dir_id WHERE directory.path >= ? AND directory.path <= ? ORDER BY entry.entry_id DESC LIMIT 500");
        $st->execute(array($pad->path, $pad->path . 'z'));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['entry.entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function childrenHistory( Scratchpad $pad ){
        $db = $this->db();
        $st = $db->prepare("SELECT entry.entry_id  FROM directory INNER JOIN entry ON directory.dir_id = entry.dir_id WHERE directory.parent ? ORDER BY entry.entry_id DESC LIMIT 500");
        $st->execute(array($pad->dir_id));
        $ids = array();
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) $ids[] = $row['entry.entry_id'];
        $st->closeCursor();
        return $ids;
    }
    
    public function store( Scratchpad $pad ){
        if( ! isset( $pad->path ) ) return;
        if( ! $this->init($pad) ) return;
        $pad->created = $this->now();
        if( ! $pad->author ) $pad->author = 0;
        $db = $this->db();
        $st = $db->prepare( "INSERT INTO entry (dir_id, author, created, body) VALUES (:dir_id, :author, :created, :body)");
        $st->execute( array('dir_id'=>$pad->dir_id, 'author'=>$pad->author, 'created'=>$pad->created, 'body'=>$pad->body) );
        $pad->entry_id = $db->lastInsertId();
        $st = $db->prepare("UPDATE directory SET entry_id = :entry_id WHERE dir_id = :dir_id");
        $st->execute(array('entry_id'=>$pad->entry_id, 'dir_id'=>$pad->dir_id) );
    }
    
    /*** PROTECTED FUNCTIONS BELOW ***/

    protected function init( Scratchpad $pad ){
        if( $pad->dir_id ) return $pad->dir_id;
        $db = $this->db();
        $st_select = $db->prepare("SELECT dir_id FROM directory WHERE path = ?");
        $st_insert = $db->prepare("INSERT INTO directory (path, parent) VALUES (:path, :parent)");
        $parent = 0;
        $subdir = '';
        $path = '';
        foreach( explode('/', $pad->path) as $dir ){
            $path .= '/' . $dir;
            $path = '/' . trim($path, '/');
            $st_select->execute(array($path));
            $data = $st_select->fetch(PDO::FETCH_ASSOC);
            $st_select->closeCursor();
            if( $data ){
                $parent = $data['dir_id'];
            } else {
                $st_insert->execute(array('path'=>$path, 'parent'=>$parent));
                $parent = $db->lastInsertId();
            }
        }
        return $pad->dir_id = $parent;
    }
   
    protected function db(){
        if( isset( self::$db ) ) return self::$db;
        $db = new PDO('sqlite2:' . ROOT_DIR . 'db' . DIRECTORY_SEPARATOR . self::filename, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
    
    protected function now(){
        return time();
    }
}
//EOF