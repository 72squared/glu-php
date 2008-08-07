<?php
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl') . '/';
$term = $this->dispatch(ROOT_DIR . 'load/request')->term;
?>
<form action="<?php echo $baseurl;?>" method="POST" class="global-search" >
<fieldset>
<input type="text" name="term" value="<?php echo $term; ?>"/>
<input type="submit" value="Search" />
<input type="hidden" name="route" value="search"/>
</fieldset>
</form>
