<?

$controller = $input->controller;

unset( $input->controller );


return $this->dispatch('format/url', 
                array(  'url'=>filter_var( $_SERVER['SCRIPT_NAME'] ) . '/' . filter_var($controller), 
                        'parameters'=>$input->export(),
                        ) 
                );

// EOF