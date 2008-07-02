<form action="<?php echo $this->instance(array('view'=>$this->action) )->dispatch(dir::layout . 'selfurl.php'); ?>" method="<?php echo $this->method;?>" >
<input name="name" type="text" /> <input type="submit" value="Go!" />
</form>