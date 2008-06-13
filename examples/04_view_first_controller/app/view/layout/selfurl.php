<?
//find the current dir
$cwd = dirname(__FILE__);

// extract the view
$view = $this->view;

// remove it from the parameter list
unset( $this->view );

$base_url = ( function_exists('filter_var') ) ? filter_var( $_SERVER['SCRIPT_NAME'] ) : $_SERVER['SCRIPT_NAME'];

// build the url and return it.
return $this->instance(
                        array( 'url'=> $base_url . '/' . preg_replace('/[^a-z0-9\/\_]/i', '', $view), 
                               'parameters'=>$this->export(),
                            ) 
                        )->dispatch($cwd . '/url.php');
// EOF