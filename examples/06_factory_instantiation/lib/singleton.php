<?
$class = $this->class;


// generate a safe key based on the filename.
$key = '___' . md5(__FILE__ . $class);

// check to see if the object exists yet.
if( $this->$key instanceof $class ) return $this->$key;

// return the newly instantiated object object.
return $this->$key = new $class;

// EOF