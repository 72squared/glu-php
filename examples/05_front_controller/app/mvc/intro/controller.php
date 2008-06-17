<?
$cwd = dirname(__FILE__) . DIRECTORY_SEPARATOR;
$input->data = self::dispatch($cwd . 'model.php', $input->request);
return self::dispatch($cwd .'view.php', $input);

// EOF
