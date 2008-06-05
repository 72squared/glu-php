<?
// extract the route
$route = $input->route;

// remove it from the parameter list
unset( $input->route );

$base_url = ( function_exists('filter_var') ) ? filter_var( $_SERVER['SCRIPT_NAME'] ) : $_SERVER['SCRIPT_NAME'];

// build the url and return it.
return $this->dispatch('util/url', 
                array(  'url'=> $base_url . '/' . 
                                preg_replace('/[^a-z0-9\/\_]/i', '', $route), 
                        'parameters'=>$input->export(),
                        ) 
                );

// EOF