<?php if(!defined('ADMIN_ROOT')) {exit('error!');}?>
<div class=containertitle><b>页面管理</b>
<?php if(isset($_GET['active_del'])):?><span class="actived">删除页面成功</span><?php endif;?>
<?php if(isset($_GET['active_hide_n'])):?><span class="actived">发布页面成功</span><?php endif;?>
<?php if(isset($_GET['active_hide_y'])):?><span class="actived">禁用页面成功</span><?php endif;?>
</div>
<div class=line></div>
<form action="page.php?action=operate_page" method="post" name="form_page" id="form_page">
  <table width="95%" id="adm_comment_list">
  	<thead>
      <tr class="rowstop">
      	<td width="21"><input onclick="CheckAll(this.form)" type="checkbox" value="on" name="chkall" /></td>
        <td width="420"><b>标题</b></td>
        <td width="30" align="center"><b>查看</b></td>
        <td width="30" align="center"><b>评论</b></td>
        <td width="150"><b>时间</b></td>
      </tr>
    </thead>
    <tbody>
	<?php
	foreach($pages as $key => $value):
	if (empty($navibar[$value['gid']]['url']))
	{
		$navibar[$value['gid']]['url'] = '../?action=showlog&gid='.$value['gid'];
	}
	$isHide = $value['hide'] == 'y' ? "<font color=\"red\">[隐藏]</font>" : '';
	?>
     <tr>
     	<td><input type="checkbox" name="page[<?php echo $value['gid']; ?>]" value="1" class="ids" /></td>
        <td><a href="page.php?action=mod&id=<?php echo $value['gid']?>"><?php echo $value['title']; ?></a> <?php echo $isHide; ?></td>
		<td align="center">
		<a href="<?php echo $navibar[$value['gid']]['url']; ?>" target="_blank" title="在新窗口查看">
		<img src="./views/<?php echo ADMIN_TPL; ?>/images/vlog.gif" align="absbottom" border="0" /></a>
		</td>
        <td align="center"><a href="comment.php?gid=<?php echo $value['gid']; ?>"><?php echo $value['comnum']; ?></a></td>
        <td><?php echo $value['date']; ?></td>
     </tr>
	<?php endforeach; ?>
	</tbody>
  </table>
  <input name="operate" id="operate" value="" type="hidden" />
</form>
<div class="list_footer">选中项：
<a href="javascript:pageact('del');">删除</a> 
<a href="javascript:pageact('hide');">隐藏</a> 
<a href="javascript:pageact('pub');">发布</a>
</div>
<div class="page">(有<?php echo $pageNum; ?>个页面)<?php echo $pageurl; ?></div>
<div style="margin:30px 0px 0px 3px;"><input name="" type="button" onclick="window.location='page.php?action=new';" value="新建一个页面&raquo;" class="submit" /></div>
<script>
$(document).ready(function(){
	$("#adm_comment_list tbody tr:odd").addClass("tralt_b");
	$("#adm_comment_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")})
});
setTimeout(hideActived,2600);
function pageact(act){
	if (getChecked('ids') == false) {
		alert('请选择要操作的日志');
		return;}
	if(act == 'del' && !confirm('你确定要删除所选页面吗？')){return;}
	$("#operate").val(act);
	$("#form_page").submit();
}
</script>