<?
$path = trim( $this->dispatch(ROOT_DIR . 'load/path'), ' /');
if(substr($path, -5) != '.text') return FALSE;
header('Content-Type: text/plain');
$author = $this->dispatch(ROOT_DIR . 'load/author');
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$nickname = ( $author->nickname ) ? $author->nickname : 'Anonymous'; 
$body = ( $pad->body ) ? $pad->body : '#Page does not exist yet';
$modified = $pad->created ? 'last modified this page on ' . date('Y-m-d H:i:s', $pad->created) : '';
?>
<script language="php"> echo $body; </script>


<script language="php"> echo $nickname; </script> <script language="php"> echo $modified; </script>