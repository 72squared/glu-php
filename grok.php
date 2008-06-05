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
    * include a file according to the argument and return the result.
    * @param string     relative path to the include, minus the php file extension.
    * @param mixed      array/iterator/grok ... we always convert this into a grok.
    * @return mixed     returns whatever the include file decided to return. depends largely
    *                   on context.
    */
    public function dispatch( $__arg, $input = NULL );
    
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
    * set the internal app.
    */
    private $__app = '';
    
   /**
    * @see Grok_Interface::__construct
    */
    public function __construct( $input = NULL ){
        
        if( is_scalar( $input ) ){
            $input = rtrim($input, ' /');
            if( ! $input ) return;
            $this->__app = preg_replace("/[^a-z0-9\/\_]/i", "", $input) . '/';
        }
        $this->import( $input );
    }
    
   /**
    * @see Grok_Interface::dispatch
    */
    public function dispatch($__arg, $input = NULL ){
        // i know it is an expensive preg, but i want to make sure nothing fishy is going on.
        // this is really the only dangerous part of the code, so i gotta protect myself.
        $__arg = preg_replace("/[^a-z0-9\/\_]/i", "", $__arg );
        
        // build the file path
        $__file = $this->__app . $__arg . '.php';
        
        // make sure we are using the correct filepath delimiter here
        if( '/' != DIRECTORY_SEPARATOR ) $__file = str_replace('/', DIRECTORY_SEPARATOR, $__file );
        
        // blow up if we can't find the path to this file.
        if( ! file_exists( $__file ) ) throw new Exception('invalid-dispatch: ' . $__arg );
        
        // make sure the input is a grok.
        if( ! $input instanceof Grok_Interface ) $input = new Grok( $input );
        
        // include the file and return the result.
        return  include $__file;
    }
    
   /**
    * @see Grok_Interface::import
    */
    public function import( $input ){
        // if the input is an grok, we can convert the it to an array
        // so we can treat them all the same.
        if( $input instanceof Grok_Interface ) $input = $input->export();
        
        // we can only loop through the data if it is an array
        if( is_array( $input ) || $input instanceof Iterator ) {
            // make sure the keys are safe. we are a bit restrictive ... but for most things, should be fine.
            foreach( $input as $k=>$v ) $this->__set( preg_replace("/[^a-z0-9\_]/i", "", $k ), $v);
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
// EOF