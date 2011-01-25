<?php $currenturl = $this->selfurl . $this->path; ?>

</div>
<div class="global-footer">
<?php $this->dispatch( $this->dir->VIEW . 'auth/userlinks'); ?>
<?php if( $this->START_TIME ): ?>
<em>
page generated in <?php echo  number_format( microtime(TRUE) - $this->START_TIME, 5); ?> seconds
</em>
<?php endif; ?>
</div>
</body>
</html>
