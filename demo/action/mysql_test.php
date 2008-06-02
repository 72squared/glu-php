<?
// get the current time by asking the db to give us the unix timestamp based on php's current time
$time = $this->dispatch('query/unix_timestamp', array( 'datetime'=>date('Y/m/d H:i:s') ) );

// have the db figure out the checksum
$checksum = $this->dispatch('query/crc32', array('string'=>$time ) );

// there you have it. very stupid, but it illustrates the concepts.
// you can use this same approach to do pretty much anything with a database.
return array( 'time'=> $time,
              'crc32' =>$checksum,
            );

// EOF