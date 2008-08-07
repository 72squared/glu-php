<?php
$pad = $this->dispatch(ROOT_DIR . 'load/scratchpad');
$baseurl = $this->dispatch(ROOT_DIR . 'load/baseurl');
$request = $this->dispatch(ROOT_DIR . 'load/request');
$currenturl = $baseurl . $pad->path;

if( $request->route == 'edit' ){
    $link_route = $currenturl;
    if( $request->entry_id ) $link_route .= '?entry_id=' . $pad->entry_id;
    $link_txt = 'show';
} elseif( $request->route == '' || $request->route == 'display') {
    $link_route = $currenturl . '?route=edit';
    if( $request->entry_id ) $link_route .= '&entry_id=' . $pad->entry_id;
    $link_txt = 'edit';
}
?>
<ul class="scratchpad-nav">
<li><a href="<?php echo $link_route; ?>"><?php echo $link_txt ?></a></li>
<li><a href="<?php echo $currenturl . '?route=history'; ?>">history</a></li>
<li><a href="<?php echo $currenturl . '?route=index'; ?>">related</a></li>
<li><a href="<?php echo $currenturl . '.text'; ?>" target="_blank">plain text</a></li>
</ul>

