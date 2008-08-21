<?php $currenturl = $this->baseurl . $this->path; ?>

</div>
<div class="global-footer">
<?php $this->dispatch( $this->dir->TPL . 'auth/userlinks'); ?>
<?php if( $this->SCRIPT_START_TIME ): ?>
<em>
page generated in <?php echo  number_format( microtime(TRUE) - $this->SCRIPT_START_TIME, 5); ?> seconds
</em>
<?php endif; ?>
</div>
</body>
</html>
