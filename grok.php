<?
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
class Grok_Container {
    
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
        
        // if we get an array, just write it in.
        if( is_array( $input ) ) return $this->__data = $input;
        
        // if the input is an grok, use the export to write the current data.
        if( $input instanceof self ) return $this->__data = $input->export();
        
        // dunno what this is. pass it off to import to figure out.
        return $this->import( $input );
    }
    
   /**
    * takes input and merges it over the top of the existing internal data.
    * returns the same value you passed in.
    * @param mixed ...  array/iterator/grok
    * @return mixed
    */
    public function import( $input ){
        // if the input is an grok, we loop through the export.
        if( $input instanceof self ) {
            foreach( $input->export() as $k=>$v ) $this->__set( $k, $v );
        
        // loop through the data if it is an array or an iterator
        } elseif( is_array( $input ) || $input instanceof Iterator ) {
            // not sanitizing the keys at all here, so you might only be able to consume
            // some of the data if you do $grok->export().
            foreach( $input as $k=>$v ) $this->__set( $k, $v);
        }
        // all done.
        return $input;
    }
    
   /**
    * export the internal data set
    * @return array
    */
    public function export(){
        return $this->__data;
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    private function __set( $k, $v ){
        return $this->__data[ $k ] = $v;
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    private function __get( $k ){
        return isset( $this->__data[ $k ] ) ? $this->__data[ $k ] : NULL;
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    private function __unset( $k ){
        unset( $this->__data[ $k ] );
    }
    
   /**
    * @see http://www.php.net/oop5.magic
    */
    private function __isset( $k ){
        return isset( $this->__data[ $k ] ) ? TRUE : FALSE;
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
    * @param string      $file
    * @return Grok
    */
    public static function instance($input = NULL ){
        return new self( $input );
    }
    
   /**
    * Dispatch the file.
    * @param string     $file
    * @param mixed      $input
    * @return mixed
    */
    public static function dispatch( $file, $input = NULL ){
        static $groks;
        if( ! isset( $groks ) ) $groks = array();
        if( ! isset( $groks[ $file ] ) ) $groks[ $file ] = self::instance();
        $data = $groks[ $file ]->process( $file, $input );
        if( ! $groks[ $file ]->stateful ) unset( $groks[ $file ] );
        return $data;
    }
    
   /**
    * Do not call directly. use dispatch or singletonDispatch.
    * @param string
    * @param mixed
    * @return mixed
    */
    protected function process( $__file, $input = NULL){
        
        // make sure we have proper input
        if( ! $input instanceof Grok_Container ) $input = self::container( $input );
        
        // make sure we are using the correct filepath delimiter here
        if( '/' != DIRECTORY_SEPARATOR ) $__file = str_replace('/', DIRECTORY_SEPARATOR, $__file );
        
        // blow up if we can't find the path to this file.
        if( ! file_exists( $__file ) ) throw $this->exception('invalid-dispatch: ' . $__file );
        
        // include the file.
        return include $__file;
    }
    
   /**
    * build a container instance.
    * @param mixed
    * @return Grok_Container
    */
    public static function container( $input = NULL ){
        return new Grok_Container( $input );
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
}

/**
 * Stub class Grok_Exception
 */
 class Grok_Exception extends Exception {
 
 }
// EOF
