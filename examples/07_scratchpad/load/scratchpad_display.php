<?

$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$author = $this->dispatch(ROOT_DIR . 'load/author');
$nickname = ( $author->nickname ) ? $author->nickname : 'Anonymous'; 
$baseurl = $this->dispatch( ROOT_DIR . 'load/baseurl');
$parser = new Markdown_Parser;
$body = $pad->body;
if( ! $pad->entry_id ) $body = '#directory only';
if( ! $pad->dir_id )  $body = '#Page does not exist yet';
$body = $parser->transform($body);
$body = preg_replace('#<a[\s]+href="([a-z0-9_\-\/\.]+)"#i', '<a href="' . $baseurl . '${1}"', $body);

$details = new Grok;
$details->path = $pad->path;
$details->entry_id = $pad->entry_id;
$details->dir_id = $pad->dir_id;
$details->body = $body;
$details->nickname = $nickname;
$details->baseurl = $baseurl;
$details->created = $pad->created ? date('Y/m/d H:i:s', $pad->created ) : '';

return $details;