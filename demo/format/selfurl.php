<?
// extract the view
$view = $input->view;

// remove it from the parameter list
unset( $input->view );

// build the url and return it.
return $this->dispatch('format/url', 
                array(  'url'=> filter_var( $_SERVER['SCRIPT_NAME'] ) . '/' . 
                                preg_replace('/[^a-z0-9\/\_]/i', '', $view), 
                        'parameters'=>$input->export(),
                        ) 
                );

// EOF