<?
//find the current dir
$cwd = dirname(__FILE__);

// if we are running the ajax response, render the response
if( $this->request->response ) return $this->dispatch($cwd . '/ajaxview.php');

// if it is the script, display the js
if( $this->request->script ) return $this->dispatch($cwd . '/layout/js/script/callajax.php');


// render the view
return $this->dispatch($cwd . '/view.php');

// EOF