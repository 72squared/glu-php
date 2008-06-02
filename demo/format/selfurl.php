<?
// extract the view
$view = $input->view;

// remove it from the parameter list
unset( $input->view );

$base_url = ( function_exists('filter_var') ) ? filter_var( $_SERVER['SCRIPT_NAME'] ) : $_SERVER['SCRIPT_NAME'];

// build the url and return it.
return $this->dispatch('format/url', 
                array(  'url'=> $base_url . '/' . 
                                preg_replace('/[^a-z0-9\/\_]/i', '', $view), 
                        'parameters'=>$input->export(),
                        ) 
                );

// EOF