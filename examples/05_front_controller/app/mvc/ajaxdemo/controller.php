<?
// if we are running the ajax response, render the response
if( $this->request->response ) return $this->dispatch('ajaxview.php');

// if it is the script, display the js
if( $this->request->script ) return $this->dispatch('layout/js/script/callajax.php');


// render the view
return $this->dispatch('view.php');

// EOF