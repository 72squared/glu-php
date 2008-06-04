<?
// run the query.
$rs = $this->dispatch('query/plants');
 
// initialize the list of plant names
$plants = array();
 
// pull down all the plant names.
while( $row = $rs->fetch() ) $plants[] = $row['plant_name'];

// return the list of plants.
return new self( array('plants'=> $plants ) );

// EOF