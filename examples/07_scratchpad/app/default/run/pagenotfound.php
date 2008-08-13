<?
 $msg = '404 Not Found';
header($_SERVER['SERVER_PROTOCOL']. ' ' . $msg);
header("Status: " . $msg);
?>
<h1>PAGE NOT FOUND</h1>