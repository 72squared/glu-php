<form action="<?=self::dispatch(dir::layout . 'selfurl.php', array('view'=>$input->action) ); ?>" method="<?=$input->method;?>" >
<input name="name" type="text" /> <input type="submit" value="Go!" />
</form>