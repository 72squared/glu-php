<?
$cookie_name = 'scratchpad_token';
if( isset( $_COOKIE[$cookie_name] ) && preg_match('#^[a-z0-9]{32}$#', $_COOKIE[$cookie_name]) ) return $_COOKIE[$cookie_name];
$charset = 'abcdefghijklmnopqrstuvwxyz0123456789';
$rand = '';
$len = strlen($charset ) - 1;
for ($i=0; $i<32; $i++) $rand .= $charset[(mt_rand(0,$len))];
$__COOKIE[ $cookie_name ] = $rand;
setcookie($cookie_name, $rand, 0);
return $rand;
