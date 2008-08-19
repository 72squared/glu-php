<?php
/**
 * GROK :: lightweight app framework
 *
 * This is really just a container class with a pretty slick way of processing includes.
 * we can use the dispatch method to run actions, build views, render templates, include libraries,
 * fetch resources, and any number of other fun tricks.
 * @author John Loehrer <john@72squared.com>
 */

/**
 * Underlying container class of Grok.
 *
 * Not recommended to use this directly.
 * Keeping the container class separate from Grok allows us to ensure that internal variables don't
 * collide with the variables used in writing to a Grok in an include file.
 */
class Grok_Container implements Iterator {
    
   /**
    * internal data storage
    */
    private $__data = array();
    
   /**
    * Build a new grok object
    * accepts an array or another Grok which is used to populate the internal data
    * @param mixed ...  array/iterator/grok  (optional)
    * @return void
    */
    public function __construct( $input = NULL ){
        // optimize for the most common cases first. if null, do nothing.
        if( $input === NULL ) return;
        
        // if the input is an grok, we loop through the export.
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
        return current($this->__data);
    }
    
   /**
    * @see http://www.php.net/manual/en/language.oop5.iterations.php
    **/
    public function key() {
        return key($this->__data);
    }
    
   /**
    * @see http://www.php.net/manual/en/language.oop5.iterations.php
    **/
    public function next() {
        return next($this->__data);
    }
    
   /**
    * @see http://www.php.net/manual/en/language.oop5.iterations.php
    **/
    public function valid() {
        return ($this->current() !== false);
    }
    
   /**
    * @see http://www.php.net/manual/en/language.oop5.iterations.php
    **/
    public function rewind() {
        reset($this->__data);
    }
    
   /**
    * @see http://www.php.net/manual/en/function.count.php
    **/
    public function count() {
        return count($this->__data);
    }
    
   /**
    * @see http://www.php.net/manual/en/function.array-keys.php
    **/
    public function keys(){
        return array_keys( $this->__data );
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    protected function __set( $k, $v ){
        return $this->__data[ $k ] = $v;
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    protected function __get( $k ){
        return isset( $this->__data[ $k ] ) ? $this->__data[ $k ] : NULL;
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    protected function __unset( $k ){
        unset( $this->__data[ $k ] );
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    protected function __isset( $k ){
        return isset( $this->__data[ $k ] ) ? TRUE : FALSE;
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    protected function __call( $class, $args ){
        if( ! class_exists( $class ) ) throw new Exception('invalid-class');
        switch( count($args)){
            case 0  : return new $class();
            case 1  : return new $class( array_pop($args ));
            case 2  : return new $class( $args[0], $args[1]);
            case 3  : return new $class( $args[0], $args[1], $args[2]);
            case 4  : return new $class( $args[0], $args[1], $args[2], $args[3]);
            case 5  : return new $class( $args[0], $args[1], $args[2], $args[3], $args[4]);
            default : return new $class( $args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
        }
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    public function __toString(){
        return print_r( $this, TRUE );
    }
}
 
/**
 * Here is the actual Grok Class. Enjoy!
 */
class Grok extends Grok_Container {
    
   /**
    * Simple factory method of instantiation.
    * This is useful when writing unit tests for Grok and you need to punch out
    * the insantiation of a new Grok.
    * @param mixed      $input
    * @return Grok
    */
    public static function instance( $input = NULL ){
        return new self( $input );
    }
    
   /**
    * Factory method of instantiating exception objects.
    * @param string     $message
    * @param int        $code
    * @return Grok_Exception
    */
    public static function exception( $message = NULL, $code = 0 ){
        return new Grok_Exception( $message, $code );
    }
    
   /**
    * include a file according to the argument and return the result.
    * @param string     path to the include, minus the php file extension.
    * @return mixed     returns whatever the include file decided to return. depends largely
    *                   on context.
    */
    public function dispatch( $__file ){
        // resolve the path to the file
        $__file = $this->resolve( $__file );
        
        // blow up if we can't find the path to this file.
        if( ! file_exists( $__file ) )  throw $this->exception('invalid-dispatch: ' . $__file );
        
        // include the file and return the result.
        return include $__file;
    }
    
   /**
    * find the path to the file, and verify it exists.
    * @param string     path to the include, minus the php file extension.
    * @return string    return the resolved path to the file.
    */
    public function resolve( $__file ){
        // make sure we are using the correct filepath delimiter here
        if( '/' != DIRECTORY_SEPARATOR ) $__file = str_replace('/', DIRECTORY_SEPARATOR, $__file );
        
        // add a php extension if one can't be found.
        if( substr($__file, -4) != '.php' ) $__file .= '.php';
        
        // return the file path.
        return $__file;
    }
}

/**
 * Stub class Grok_Exception
 */
 class Grok_Exception extends Exception {
 
 }
// EOF
