<?
// extract the view
$view = $input->view;

// create a clone.
$input = self::instance( $input );

// remove it from the parameter list
unset( $input->view );

$base_url = ( function_exists('filter_var') ) ? filter_var( $_SERVER['SCRIPT_NAME'] ) : $_SERVER['SCRIPT_NAME'];

// build the url and return it.
return self::dispatch( dir::layout . 'url.php',
                        array( 'url'=> $base_url . '/' . preg_replace('/[^a-z0-9\/\_]/i', '', $view), 
                               'parameters'=>$input->export(),
                            ) 
                        );
// EOF