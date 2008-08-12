<?php
$this->session = $this->Session();
$this->user = $this->User( $this->session->user_id );
$this->pad = $this->ScratchPad( $this->path );

$this->titles = $this->Scratchpad_Lister( $this->pad->find( $this->request->term ) );
$this->keywords = $this->Scratchpad_Lister( $this->pad->search($this->request->term) );

$ids = array();
foreach( array( $this->titles, $this->keywords ) as $lister ){
    foreach( $lister as $pad ){
        if( ! $pad->author ) continue;
        $ids[$pad->author] = 1;
    }
}
$this->authors = $this->User_Lister( array_keys( $ids ) );
//EOF