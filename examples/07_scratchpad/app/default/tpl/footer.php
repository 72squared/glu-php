<?php $currenturl = $this->baseurl . $this->path; ?>

</div>
<div class="global-footer">
<form action="<?php echo $currenturl ?>" method="POST" class="global-search" >
<fieldset>
<input type="text" name="term" value="<?php echo $this->request->term; ?>"/>
<input type="submit" value="Search" />
<input type="hidden" name="route" value="search"/>
</fieldset>
</form>

<?php $this->dispatch(dirname(__FILE__) . '/userauthlinks'); ?>
<?php if( $this->SCRIPT_START_TIME ): ?>
<em>
page generated in <?php echo  number_format( microtime(TRUE) - $this->SCRIPT_START_TIME, 5); ?> seconds
</em>
<?php endif; ?>
</div>
</body>
</html>
