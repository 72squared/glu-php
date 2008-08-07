<?php $this->instance(array('title'=>'Error'))->dispatch(ROOT_DIR . 'layout/global/header'); ?>
<div id="content">
<?php $this->instance(array('header'=>'An error occurred', 'body'=>$this->exception ))->dispatch(ROOT_DIR . 'layout/global/message'); ?>
</div>
<?php $this->instance()->dispatch(ROOT_DIR . 'layout/global/footer'); ?>
