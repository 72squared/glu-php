<?
// This demo shows how to build a very simple factory method of instantiation, and to keep
// singleton instances of the object available. this example is not very useful but might give
// ideas on how the pattern could be used for other real-life purposes.

// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// include the grok class
include '../../grok.php';

// instantiate the grok and set the app
$test = new Grok('lib');

try {
    // create the table.
    $test->dispatch('query/author/create');
    
    // insert a row
    $id = $test->dispatch('query/author/insert', array('first'=>'mark', 'last'=>'twain') );
    
    // insert a row
    $id = $test->dispatch('query/author/insert', array('first'=>'william', 'last'=>'shakespeare') );
    
    // insert a row
    $id = $test->dispatch('query/author/insert', array('first'=>'john', 'last'=>'l0cke') );
    
    // correct a mistake with an update
    $test->dispatch('query/author/update',  array('id'=>$id, 'first'=>'john', 'last'=>'locke') );
    
    // run a query to find all the rows.
    $iterator = $test->dispatch('query/author/select');
    
    // display them all
    for( $iterator->rewind(); $iterator->valid(); $iterator->next() ){
        print_r( $iterator->current() );
    }
    
    // drop the table.
    $test->dispatch('query/author/drop');
    
    // handle the exception.
} catch( Exception $e ){
    print "\n\n" . $e . "\n";
}
print "\nDONE\n";
// EOF