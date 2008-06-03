<?
// SQLITE DSN INFO
$options = array('filename'=>$this->app . '/sqlite/grok.db' , 'mode'=>'0666' );

// connect to the db.
return $this->dispatch('db/sqlite', $options );

// EOF