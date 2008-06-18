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
        // if null, do nothing.
        if( $input === NULL ) return;
        
        // pass off to common.
        $this->import( $input );
    }
    
   /**
    * takes input and merges it over the top of the existing internal data.
    * returns the same value you passed in.
    * @param mixed ...  array/iterator/grok
    * @return mixed
    */
    public function import( $input ){
        // loop through the data if it is an array or an iterator
        if( is_array( $input ) || $input instanceof Iterator ) {
            // not sanitizing the keys at all here, so you might only be able to consume
            // some of the data if you do $grok->export().
            foreach( $input as $k=>$v ) $this->__set( $k, $v);
        
        // if the input is an grok, we loop through the export.
        } elseif( $input instanceof self ) {
            foreach( $input->export() as $k=>$v ) $this->__set( $k, $v );
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
* Internal class. do not use directly.
* This class keeps a mapping of all the grok states per file.
*/
class Grok_FileState {
    /**
    * Mapping of files to state classes.
    */
    private static $__files = array();
    
    /**
    * get the grok state for a file.
    * if no state exists, create one.
    * @param string
    * @return Grok
    */
    public static function get( $file ){
        return isset( self::$__files[ $file ] ) ? self::$__files[ $file ] : self::$__files[ $file ] = new Grok;
    }
    
   /**
    * remove a grok state for a file.
    * @param string
    * @return void
    */
    public static function remove( $file ){
        unset( self::$__files[ $file ] );
    }
    
    /**
    * clear all the mappings.
    * @return void
    */
    public static function clear(){
        self::$__files = array();
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
    public static function instance( $input = NULL ){
        return new self( $input );
    }
    
   /**
    * Dispatch the file. the file always has its own scope limited to the current file.
    * @param string     $file
    * @param mixed      $input
    * @return mixed
    */
    public static function dispatch( $file, $input = NULL ){
        
        // make sure we are using the correct filepath delimiter here
        if( '/' != DIRECTORY_SEPARATOR ) $file = str_replace('/', DIRECTORY_SEPARATOR, $file );
        
        // blow up if we can't find the path to this file.
        if( ! file_exists( $file ) ) throw self::exception('invalid-dispatch: ' . $file );
        
        // make sure we have proper input
        if( ! $input instanceof Grok_Container ) $input = self::container( $input );
        
        // get the grok
        $grok = Grok_FileState::get( $file );
        
        // run the process command
        $data = $grok->process( $input, $file);
        
        // if there is no state to save, remove the grok
        if( count( $grok->export() ) < 1 ) Grok_FileState::remove( $file );
        
        // all done.
        return $data;
    }
    
   /**
    * Do not call directly. use dispatch or singletonDispatch.
    * @param string
    * @param mixed
    * @return mixed
    */
    protected function process( Grok_Container $input, $__file ){
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
