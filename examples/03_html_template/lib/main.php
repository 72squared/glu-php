<?

// instantiate the grok
$tpl = $this->instance();

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