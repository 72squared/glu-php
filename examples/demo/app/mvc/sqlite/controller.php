<?

// run the query.
$data = $this->dispatch('mvc/sqlite/model');

$this->dispatch('mvc/sqlite/view', $data );

// EOF