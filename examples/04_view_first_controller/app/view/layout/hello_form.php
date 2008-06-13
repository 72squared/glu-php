<?
//find the current dir
$cwd = dirname(__FILE__);

?>
<form action="<?=$this->instance(array('view'=>$this->action) )->dispatch($cwd . '/selfurl.php'); ?>" method="<?=$this->method;?>" >
<input name="name" type="text" /> <input type="submit" value="Go!" />
</form>