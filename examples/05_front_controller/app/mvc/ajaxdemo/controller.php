<?
//find the current dir
$cwd = dirname(__FILE__);

// if we are running the ajax response, render the response
if( $input->request->response ) return self::dispatch($cwd . '/ajaxview.php', $input);

// if it is the script, display the js
if( $input->request->script ) return self::dispatch(dir::layout . 'js/script/callajax.php', $input);


// render the view
return self::dispatch($cwd . '/view.php', $input);

// EOF