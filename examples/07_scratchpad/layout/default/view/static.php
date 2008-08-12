<?php
$basedir = dirname(__FILE__);
$file = dirname($basedir) . '/static/' . DIRECTORY_SEPARATOR . $this->path;
if( ! file_exists( $file ) ) return $this->dispatch($basedir . '/pagenotfound');
$fp = @fopen($file, 'r');
if( ! $fp ) return $this->dispatch($basedir . '/pagenotfound');
header('Content-Type: ' .  $extensions[$ext]);
//header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 1000000));
fpassthru($fp);
fclose($fp);
return TRUE;

//EOF