<?
class Instantiator {

   /**
    * @see http://www.php.net/oop5.magic
    */
    public function __call( $class, $args ){
        if( ! class_exists( $class ) ) throw new Exception('invalid-class');
        switch( count($args)){
            case 0  : return new $class();
            case 1  : return new $class( array_pop($args ));
            case 2  : return new $class( $args[0], $args[1]);
            case 3  : return new $class( $args[0], $args[1], $args[2]);
            case 4  : return new $class( $args[0], $args[1], $args[2], $args[3]);
            case 5  : return new $class( $args[0], $args[1], $args[2], $args[3], $args[4]);
            case 6  : return new $class( $args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
            default : return new $class( $args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
        }
    }
}