<?php
/**
 * GLU :: lightweight app framework
 *
 * This is a container class with a pretty slick way of processing includes.
 * we can use the dispatch method to run actions, build views, render templates, include libraries,
 * fetch resources, and any number of other fun tricks, including a map-reduce style approach to processing.
 * @author John Loehrer <john@72squared.com>
 */

/**
 * Underlying container class of Glu.
 *
 * Not recommended to use this directly.
 * Keeping the container class separate from Glu allows us to ensure that internal variables don't
 * collide with the variables used in writing to a Glu in an include file.
 */
class Glu_Pot implements Iterator {
    
   /**
    * internal data storage
    */
    private $__d = array();
    
   /**
    * Build a new glu object
    * accepts an array or another Glu which is used to populate the internal data
    * @param mixed ...  array/iterator/glu  (optional)
    * @return void
    */
    public function __construct( $input = NULL ){
        // optimize for the most common cases first. if null, do nothing.
        if( $input === NULL ) return;
        
        // if the input is an glu, we loop through the export.
        if( is_array( $input ) || $input instanceof Iterator ) {
            // not sanitizing the keys at all here, so you might only be able to consume
            // some of the data.
            foreach( $input as $k=>$v ) $this->__set( $k, $v);
        }
        // all done.
    }
    
   /**
    * @see http://www.php.net/manual/en/language.oop5.iterations.php
    **/
    public function current() {
        return current($this->__d);
    }
    
   /**
    * @see http://www.php.net/manual/en/language.oop5.iterations.php
    **/
    public function key() {
        return key($this->__d);
    }
    
   /**
    * @see http://www.php.net/manual/en/language.oop5.iterations.php
    **/
    public function next() {
        return next($this->__d);
    }
    
   /**
    * @see http://www.php.net/manual/en/language.oop5.iterations.php
    **/
    public function valid() {
        return ($this->key() !== NULL);
    }
    
   /**
    * @see http://www.php.net/manual/en/language.oop5.iterations.php
    **/
    public function rewind() {
        reset($this->__d);
    }
    
   /**
    * @see http://www.php.net/manual/en/function.count.php
    **/
    public function count() {
        return count($this->__d);
    }
    
   /**
    * @see http://www.php.net/manual/en/function.array-keys.php
    **/
    public function keys(){
        $args = func_get_args();
        if( count($args) < 1 ) return array_keys( $this->__d);
        $search = array_shift( $args );
        $strict = array_shift( $args );
        return array_keys( $this->__d, $search, $strict);
    }
    
   /**
    * @see http://www.php.net/manual/en/function.array-push.php
    **/
    public function push($v){
        $keys = $this->keys();
        return $this->{count( $keys ) > 0 ? max($keys) + 1 : 0} = $v;
    }
    
   /**
    * @see http://www.php.net/manual/en/function.array-pop.php
    **/
    public function pop(){
        return array_pop($this->__d);
    }
    
   /**
    * @see http://www.php.net/manual/en/function.array-shift.php
    **/
    public function shift(){
        return array_shift($this->__d);
    }
    
   /**
    * @see http://www.php.net/manual/en/function.array-unshift.php
    **/
    public function unshift($v){
        $keys = $this->keys();
        return $this->{count( $keys ) > 0 ? min($keys) -1 : 0} = $v;
    }
    
   /**
    * @see http://www.php.net/manual/en/function.asort.php
    **/
    public function sort($sort_flags = NULL){
        return asort($this->__d, $sort_flags );
    }
    
   /**
    * @see http://www.php.net/manual/en/function.arsort.php
    **/
    public function rsort($sort_flags = NULL){
        return arsort($this->__d, $sort_flags );
    }
   
   /**
    * @see http://www.php.net/manual/en/function.ksort.php
    **/
    public function ksort($sort_flags = NULL){
        return ksort($this->__d, $sort_flags);
    }
    
   /**
    * @see http://www.php.net/manual/en/function.ksort.php
    **/
    public function krsort($sort_flags = NULL){
        return krsort($this->__d, $sort_flags);
    }
    
   /**
    * @see http://www.php.net/manual/en/function.array-values.php
    **/
    public function values(){
        return array_values( $this->__d );
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    public function __set( $k, $v ){
        return $this->__d[ $k ] = $v;
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    public function __get( $k ){
        return isset( $this->__d[ $k ] ) ? $this->__d[ $k ] : NULL;
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    public function __unset( $k ){
        unset( $this->__d[ $k ] );
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    public function __isset( $k ){
        return isset( $this->__d[ $k ] ) ? TRUE : FALSE;
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    public function __toString(){
        return print_r( $this, TRUE );
    }
}
 
/**
 * Here is the actual Glu Class. Enjoy!
 */
class Glu extends Glu_Pot {
    
   /**
    * Simple factory method of instantiation.
    * This is useful when writing unit tests for Glu and you need to punch out
    * the insantiation of a new Glu.
    * @param mixed      $input
    * @return Glu
    */
    public static function instance( $input = NULL ){
        return new self( $input );
    }
    
   /**
    * Factory method of instantiating exception objects.
    * @param string     $message
    * @param int        $code
    * @return Glu_Exception
    */
    public static function exception( $message = NULL, $code = 0 ){
        return new Glu_Exception( $message, $code );
    }
    
   /**
    * include a file according to the argument and return the result.
    * @param string     path to the include, minus the php file extension.
    * @param boolean    do we want to validate the file path?
    * @return mixed     returns whatever the include file decided to return. depends largely
    *                   on context.
    */
    public function dispatch( $__file, $__strict = FALSE ){
       // make sure we are using the correct filepath delimiter here
        if( '/' != DIRECTORY_SEPARATOR ) $__file = str_replace('/', DIRECTORY_SEPARATOR, $__file );
        
        // add a php extension if one can't be found.
        if( substr($__file, -4) != '.php' ) $__file .= '.php';
        
        // blow up if we can't find the path to this file.
        if( $__strict && ! file_exists( $__file ) )  throw $this->exception('invalid-dispatch: ' . $__file );
        
        // include the file and return the result.
        return include $__file;
    }
}

/**
 * Stub class Glu_Exception
 */
 class Glu_Exception extends Exception {
 
 }
// EOF
