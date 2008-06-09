<?
// if we are running the ajax response, render the response
if( $input->response ) return $this->dispatch('mvc/ajaxdemo/ajaxview', $input );

// if it is the script, display the js
if( $input->script ) return $this->dispatch('layout/js/script/callajax'); 


// render the view
return $this->dispatch('mvc/ajaxdemo/view', $input );

// EOF