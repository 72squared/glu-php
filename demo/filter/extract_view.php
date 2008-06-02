<?

$view = preg_replace( '/[^a-z0-9\/\_]/', '', str_replace( $_SERVER['SCRIPT_NAME'], '',   $_SERVER['PHP_SELF'] ) );

if( ! $view ) return 'index';

return $view;

// EOF