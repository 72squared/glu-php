<?
/**
 * GROK :: lightweight app framework
 * This is really just a container class with a pretty slick way of processing includes.
 * we can use the dispatch method to run actions, build views, render templates, include libraries,
 * fetch resources, and any number of other fun tricks.
 * @author John Loehrer <john@72squared.com>
 * Here is the public interface.
 * If you want to muck around and inject other types of Grok-like objects into the system,
 * feel free.
*/
interface Grok_Interface {
   /**
    * Class constructor.
    * accepts an array or another Grok which is used to populate the internal data
    * @param mixed ...  array/iterator/grok  (optional)
    * @return void
    */
    public function __construct( $input = NULL );
    
   /**
    * Simple factory method of instantiation.
    * This is useful when writing unit tests for Grok and you need to punch out
    * the insantiation of a new Grok.
    * @param mixed      $input
    * @return Grok_Interface
    */
    public static function instance( $input = NULL );
    
   /**
    * Factory method of instantiating exception objects.
    * @param string     $message
    * @param int        $code
    * @return Grok_Exception
    */
    public static function exception( $message = NULL, $code = 0 );
    
   /**
    * include a file according to the argument and return the result.
    * @param string     relative path to the include, minus the php file extension.
    * @param mixed      array/iterator/grok ... we always convert this into a grok.
    * @return mixed     returns whatever the include file decided to return. depends largely
    *                   on context.
    */
    public function dispatch( $__arg );
    
   /**
    * takes input and merges it over the top of the existing internal data.
    * returns the same value you passed in.
    * @param mixed ...  array/iterator/grok
    * @return mixed
    */
    public function import( $input );
    
   /**
    * export the internal data set
    * @return array
    */
    public function export();
}
 
/**
 * Here is the actual Grok Class. Enjoy!
 */
class Grok implements Grok_Interface {
    
   /**
    * internal data storage
    */
    private $__data = array();
    
   /**
    * @see Grok_Interface::__construct
    */
    public function __construct( $input = NULL ){
        // optimize for the most common cases first. if null, do nothing.
        if( is_null( $input ) ) return;
        
        // if we get an array, just write it in.
        if( is_array( $input ) ) return $this->__data = $input;
        
        // if the input is an grok, use the export to write the current data.
        if( $input instanceof Grok_Interface ) return $this->__data = $input->export();
        
        // dunno what this is. pass it off to import to figure out.
        return $this->import( $input );
    }
    
   /**
    * @see Grok_Interface::instance
    */
    public static function instance( $input = NULL ){
        return new self( $input );
    }
    
   /**
    * @see Grok_Interface::exception
    */
    public static function exception( $message = NULL, $code = 0 ){
        return new Grok_Exception( $message, $code );
    }
    
    
   /**
    * @see Grok_Interface::dispatch
    */
    public function dispatch( $__file ){
        
        // make sure whe know what the current directory is, so we can bounce back.
        $__cwd = getcwd();
        
        // trim the filename
        $__file = trim( $__file );
        
        // the file passed in is an empty string. blow up.
        if( ! $__file ) throw $this->exception('invalid-dispatch: ' . $__file );
        
        // build the file path
        if( substr($__file, 0, 1) != DIRECTORY_SEPARATOR ) $__file = $__cwd . '/' . $__file;
        
        // make sure we are using the correct filepath delimiter here
        if( '/' != DIRECTORY_SEPARATOR ) $__file = str_replace('/', DIRECTORY_SEPARATOR, $__file );
        
        // blow up if we can't find the path to this file.
        if( ! is_readable( $__file ) ) throw $this->exception('invalid-dispatch: ' . $__file );
        
        // change the working directory to the same as the file we are gonna include.
        if( ! chdir( dirname( $__file ) ) )  throw $this->exception('invalid-permissions: ' . $__file );
        
        // wrap in a try/catch block
        try {
            // include the file and return the result.
            $ret = include $__file;
        
        // catch the exception so we can briefly restore the current working dir.
        } catch( Exception $e ){
            // change back to the working directory we were using before the include.
            chdir( $__cwd );
            
            // throw the exception again.
            throw $e;
        }
        
        // go back to the prev cwd
        chdir( $__cwd );
        
        // return the result
        return $ret;
    }
    
   /**
    * @see Grok_Interface::import
    */
    public function import( $input ){
        // if the input is an grok, we loop through the export.
        if( $input instanceof Grok_Interface ) {
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
    * @see Grok_Interface::export
    */
    public function export(){
        return $this->__data;
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
}

/**
 * Stub class Grok_Exception
 */
 class Grok_Exception extends Exception {
 
 }
// EOF