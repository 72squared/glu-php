<?php
$currenturl = $this->baseurl . $this->path;

if( $this->route == 'display'){
    $link_action = $currenturl . '?route=edit';
    if( $this->request->entry_id ) $link_action .= '&entry_id=' . $this->entry_id;
    $link_txt = 'edit';
} else {
    $link_action = $currenturl;
    if( $this->request->entry_id ) $link_action .= '?entry_id=' . $this->entry_id;
    $link_txt = 'display';
}
?>
<ul class="scratchpad-nav">
<li><a href="<?php echo $link_action; ?>"><?php echo $link_txt ?></a></li>
<li><a href="<?php echo $currenturl . '?route=history'; ?>">history</a></li>
<li><a href="<?php echo $currenturl . '?route=descendents'; ?>">related</a></li>
<li><a href="<?php echo $currenturl . '?route=changes'; ?>">changes</a></li>
<li><a href="<?php echo $currenturl . '?route=recent'; ?>">recent</a></li>
<li><a href="<?php echo $currenturl . '.text'; ?>" target="_blank">plain text</a></li>
</ul>

