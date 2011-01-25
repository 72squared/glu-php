<?php
if( $this->max < 2 ) return;
?>
<ul class="pagination">
<?php if( $this->current == 1): ?>
<li class="first"><span class="inactive">Prev</span></li>
<?php else: ?>
<li class="first"><a href="<?php echo str_replace('#PAGE#', $this->current - 1, $this->url ); ?>">Prev</a></li>
<?php endif; ?>


<?php if( $this->max < 8 ): ?>


<?php for( $i = 1; $i <= $this->max; $i++): ?>
<li><a href="<?php echo str_replace('#PAGE#', $i, $this->url); ?>"<?php if($i==$this->current) echo ' class="selected"'; ?>><?php echo $i; ?></a></li>
<?php endfor; ?>



<?php else: ?>


<?php if( $this->current > 3): ?>
<li><a href="<?php echo str_replace('#PAGE#', 1, $this->url); ?>">1</a></li>
<li><span class="inactive page_gap">&hellip;</span></li>
<?php endif; ?>

<?php
$start = 1;
if( $this->current > 3) $start = $this->current - 2;
if( $this->current + 3 > $this->max ) $start = $this->max - 4;
?>
<?php for( $i = $start; $i < $start + 5; $i++): ?>
<li><a href="<?php echo str_replace('#PAGE#', $i, $this->url); ?>"<?php if($i==$this->current) echo ' class="selected"'; ?>><?php echo $i; ?></a></li>
<?php endfor; ?>


<?php if($this->current + 3 <= $this->max): ?>
<li><span class="inactive page_gap">&hellip;</span></li>
<li><a href="<?php echo str_replace('#PAGE#', $this->max, $this->url); ?>"><?php echo $this->max; ?></a></li>
<?php endif; ?>




<?php endif; ?>

<?php if( $this->current >= $this->max): ?>
<li class="last"><span class="inactive">Next</span></li>
<?php else: ?>
<li class="last"><a href="<?php echo str_replace('#PAGE#', $this->current + 1, $this->url ); ?>">Next</a></li>
<?php endif; ?>
</ul>

