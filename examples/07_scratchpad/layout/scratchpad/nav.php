<?php
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$request = $this->dispatch(ROOT_DIR . 'load/request');
$currenturl = $baseurl . $pad->path;

if( $request->action == 'edit' ){
    $link_action = $currenturl;
    if( $request->entry_id ) $link_action .= '?entry_id=' . $pad->entry_id;
    $link_txt = 'show';
} elseif( $request->action == '' || $request->action == 'display') {
    $link_action = $currenturl . '?action=edit';
    if( $request->entry_id ) $link_action .= '&entry_id=' . $pad->entry_id;
    $link_txt = 'edit';
}
?>
<ul class="scratchpad-nav">
<li><a href="<?php echo $link_action; ?>"><?php echo $link_txt ?></a></li>
<li><a href="<?php echo $currenturl . '?action=history'; ?>">history</a></li>
<li><a href="<?php echo $currenturl . '?action=index'; ?>">related</a></li>
<li><a href="<?php echo $currenturl . '.text'; ?>" target="_blank">plain text</a></li>
</ul>

