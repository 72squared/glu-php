<?



class User_Storage {

    protected static $db;
    
    const filename = 'user.db';
    
    protected static $columns = array('user_id', 'nickname', 'email', 'passhash', 'created', 'modified');
    
    public function load( User $u ){
        $this->loadByUserId( $u );
        $this->loadByNickname( $u );
        $this->loadByEmail( $u );
    }
    
 public function batch(User_Lister $iterator, $ids){
        if( ! is_array($ids) || count($ids) < 1 ) return $iterator;
        $clean_ids = array();
        foreach($ids as $id ) {
            $id = intval($id );
            if( $id < 1 ) continue;
            $clean_ids[] = $id;
        }
        if( count($clean_ids ) < 1 ) return $iterator;
        $db = $this->db();
        $st = $db->query(sprintf("SELECT * FROM user WHERE user_id IN( %s )", implode(',', $clean_ids) ) );
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $k = $row['user_id'];
            $iterator->$k = new User( $row );
        }
        $st->closeCursor();
        return $iterator;
    }
    
    
    public function store( User $u ){
        if( ! $u->nickname ) throw new Exception('invalid-nickname');
        if( ! $u->passhash ) throw new Exception('invalid-passhash');
        if( ! $u->email ) throw new Exception('invalid-email');
        $u->modified = $this->now();
        if( ! $u->created ) $u->created = $this->now();
        $db = $this->db();
        $params = array();
        foreach(self::$columns as $k){
            $params[$k] = $u->$k;
        }
        if( $u->user_id ) {
            $st = $db->prepare("INSERT OR REPLACE INTO user (user_id, nickname, passhash, email, created, modified) VALUES (:user_id, :nickname, :passhash, :email, :created, :modified)");
            $st->execute($params);
            return $this->storeAttributes($u);
        }
        unset( $params['user_id'] );
        $st = $db->prepare("INSERT INTO user (nickname, passhash, email, created, modified) VALUES (:nickname, :passhash, :email, :created, :modified)");
        $st->execute( $params );
        $u->user_id = $db->lastInsertId();
        return $this->storeAttributes($u);
        
    }
    
    
    
    /*** PROTECTED FUNCTIONS BELOW ***/
    
    public function loadAttributes( User $u ){
        if( ! $u->user_id ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT label, data FROM user_attribute WHERE user_id = ?");
        $st->execute( array($u->user_id) );
        while( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
            $k = $row['label'];
            $v = $row['data'];
            $u->$k = $v;
        }
        $st->closeCursor();
    }
    
    protected function storeAttributes( User $u ){
        if( ! $u->user_id ) throw Exception('invalid-user_id');
        $db = $this->db();
        try {
            $db->beginTransaction();
            $st = $db->prepare("DELETE FROM user_attribute WHERE user_id = ?");
            $st->execute(array($u->user_id ));
            $st = $db->prepare("INSERT INTO user_attribute (user_id, label, data) VALUES (:user_id, :label, :data)");
            foreach( $u as $k => $v ){
                if( in_array($k, self::$columns) ) continue;
                $st->execute(array('user_id'=>$u->user_id, 'label'=>$k, 'data'=>$v) );
            }
            $db->commit();
        } catch( Exception $e ){
            $db->rollback();
            throw $e;
        }
    }
    
    protected function loadByUserId( User $u ){
        if( ! isset( $u->user_id )) return;
        if( isset( $u->nickname ) ) return;
        $db = $this->db();
        $st = $db->prepare('SELECT * FROM user WHERE user_id = ?');
        $st->execute( array($u->user_id ) );
        $data = $st->fetch(PDO::FETCH_ASSOC);
        $st->closeCursor();
        if( ! $data ) {
            unset( $u->user_id );
            return;
        }
        foreach( $data as $k=>$v) $u->$k = $v;
        $this->loadAttributes($u);
    }
    
        
    protected function loadByNickname( User $u ){
        if( ! isset( $u->nickname )) return;
        if( isset( $u->user_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM user WHERE nickname = ?");
        $st->execute( array( $u->nickname ) );
        $data = $st->fetch(PDO::FETCH_ASSOC);
        $st->closeCursor();
        if( ! $data ){
            unset( $u->nickname );
            return;
        }
        foreach( $data as $k=>$v) $u->$k = $v;
        $this->loadAttributes($u);
    }
    
    protected function loadByEmail( User $u ){
        if( ! isset( $u->email )) return;
        if( isset( $u->user_id ) ) return;
        $db = $this->db();
        $st = $db->prepare("SELECT * FROM user WHERE email = ?");
        $st->execute( array( $u->email ) );
        $data = $st->fetch(PDO::FETCH_ASSOC);
        $st->closeCursor();
        if( ! $data ){
            unset( $u->email );
            return;
        }
        foreach( $data as $k=>$v) $u->$k = $v;
        $this->loadAttributes($u);
    }
    
    protected function now(){
        return time();
    }
    
    protected function db(){
        if( isset( self::$db ) ) return self::$db;
        $db = new PDO('sqlite2:' . ROOT_DIR . 'db' . DIRECTORY_SEPARATOR . self::filename, NULL, NULL, array(PDO::ATTR_PERSISTENT=>TRUE));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db = $db;
    }
}

// EOF