<?
// This demo shows how to build a very simple factory method of instantiation, and to keep
// singleton instances of the object available. this example is not very useful but might give
// ideas on how the pattern could be used for other real-life purposes.

// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// include the grok class
include '../../grok.php';

// instantiate the grok and set the app
$test = Grok::instance('lib');

// get the object once
$a = $test->dispatch('/singleton', array('class'=>'stdclass') );

// print it out so we can inspect it.
print "\nA: ";
var_dump( $a );

// now get the object again.
$b = $test->dispatch('/singleton',  array('class'=>'stdclass'));

// print it out so we can see it's exact object id and compare with the earlier one.
print "\nB: ";
var_dump( $b );

// compare.
if( $a === $b ){
    print "\nSingleton returned the same object both times.\n";
} else {
    print "\nSingleton returned a different object each time.\n";
}

// ALL DONE.
print "\nDONE\n";
// EOF