<?
// find the current dir
$cwd = dirname(__FILE__) . DIRECTORY_SEPARATOR;

// let's call the helloworld model
$input->data = self::dispatch($cwd . 'model.php', $input->request);

// render the view
$this->dispatch($cwd . 'view.php', $input);

// EOF