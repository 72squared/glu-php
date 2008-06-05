<?
// This demo shows how to build a very simple html template

// include the grok class
include '../../grok.php';

// instantiate the grok and set the app
$tpl = new Grok( dirname(__FILE__) . '/tpl');

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
$tpl->dispatch('page');

// EOF