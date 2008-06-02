<?
/**
 * GROK :: lightweight app framework
 * This is really just a container class with a pretty slick way of processing includes.
 * we can use the dispatch method to run actions, build views, render templates, include libraries,
 * fetch resources, and any number of other fun tricks.
 */
class Grok {
    
   /**
    * where all the data is stored internally.
    */
    private $__data = array();
    
   /**
    * Class constructor.
    * accepts an array or another Grok which is used to populate the internal data
    * @param mixed ...  array/iterator/grok  (optional)
    * @return void
    */
    public function __construct( $input = NULL ){
        $this->import( $input );
    }
    
   /**
    * include a file according to the argument and return the result.
    * @param string     relative path to the include, minus the php file extension.
    * @param mixed      array/iterator/grok ... we always convert this into a grok.
    * @return mixed     returns whatever the include file decided to return. depends largely
    *                   on context.
    */
    public function dispatch($__arg, $input = NULL ){
        // i know it is an expensive preg, but i want to make sure nothing fishy is going on.
        // this is really the only dangerous part of the code, so i gotta protect myself.
        $__arg = preg_replace("/[^a-z0-9\/\_]/i", "", $__arg );
        
        // build the file path
        $__file = $this->app . '/' . $__arg . '.php';
        
        // make sure we are using the correct filepath delimiter here
        if( '/' != DIRECTORY_SEPARATOR ) $__file = str_replace('/', DIRECTORY_SEPARATOR, $__file );
        
        // blow up if we can't find the path to this file.
        if( ! file_exists( $__file ) ) throw new Exception('invalid-dispatch: ' . $__arg );
        
        // make sure the input is a grok.
        if( ! $input instanceof Grok ) $input = new Grok( $input );
        
        // include the file and return the result.
        return  include $__file;
    }
    
   /**
    * takes input and merges it over the top of the existing internal data.
    * returns the same value you passed in.
    * @param mixed ...  array/iterator/grok
    * @return mixed
    */
    public function import( $input ){
        // if the input is an grok, we can convert the it to an array
        // so we can treat them all the same.
        if( $input instanceof self ) $input = $input->export();
        
        // we can only loop through the data if it is an array
        if( is_array( $input ) || $input instanceof Iterator ) {
            // make sure the keys are safe. we are a bit restrictive ... but for most things, should be fine.
            foreach( $input as $k=>$v ) $this->__set( preg_replace("/[^a-z0-9\_]/i", "", $k ), $v);
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
    * return all the keys for the internal data structure
    * @return array
    */
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
}
// EOF