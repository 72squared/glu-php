<?

try {
    // create the table.
    $this->instance()->dispatch('query/author/create.php');
    
    // insert a row
    $id = $this->instance(array('first'=>'mark', 'last'=>'twain'))->dispatch('query/author/insert.php');
    
    // insert a row
    $id = $this->instance(array('first'=>'william', 'last'=>'shakespeare'))->dispatch('query/author/insert.php');
    
    // insert a row
    $id = $this->instance(array('first'=>'john', 'last'=>'l0cke'))->dispatch('query/author/insert.php');
    
    // correct a mistake with an update
    $this->instance(array('id'=>$id, 'first'=>'john', 'last'=>'locke'))->dispatch('query/author/update.php');
    
    // run a query to find all the rows.
    $iterator = $this->instance()->dispatch('query/author/select.php');
    
    // display them all
    for( $iterator->rewind(); $iterator->valid(); $iterator->next() ){
        print_r( $iterator->current() );
    }
    
    // drop the table.
    $this->instance()->dispatch('query/author/drop.php');
    
    // handle the exception.
} catch( Exception $e ){
    print "\n\n" . $e . "\n";
}
print "\nDONE\n";
// EOF