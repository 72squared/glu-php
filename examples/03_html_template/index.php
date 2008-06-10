<?
// This demo shows how to build a very simple html template


// set the working directory to this file's directory.
chdir( dirname(__FILE__) );

// include the grok class
include 'grok.php';

// instantiate the grok and set the app
$tpl = Grok::instance();

// we have a choice to either pass all the information through input,
// or simply assign the variables to the tpl itself. let's go with the
// simpler option.

// set the page title
$tpl->title = 'TPL';

// set the header
$tpl->header = 'template example';

// set the message
$tpl->message = 'shows how to build a templating system';

// render the template.
$tpl->dispatch('tpl/page');

// EOF