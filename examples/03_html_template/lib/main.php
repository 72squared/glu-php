<?
//find the current dir
$cwd = dirname(__FILE__);

// instantiate the grok
$tpl = $this->instance();

// set the page title
$tpl->title = 'TPL';

// set the header
$tpl->header = 'template example';

// set the message
$tpl->message = 'shows how to build a templating system';

// render the template.
self::dispatch($cwd . '/tpl/page.php', $tpl);

// EOF