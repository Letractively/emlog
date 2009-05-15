﻿<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div class="sidebar">
<ul>
<?php 
require_once (getViews('function'));
$widgets = !empty($options_cache['widgets1']) ? unserialize($options_cache['widgets1']) : array();
foreach ($widgets as $val)
{
	$widget_title = @unserialize($options_cache['widget_title']);
	$custom_widget = @unserialize($options_cache['custom_widget']);
	if(strpos($val, 'custom_wg_') === 0)
	{
		$callback = 'widget_custom_text';
		if(function_exists($callback))
		{
			call_user_func($callback, htmlspecialchars($custom_widget[$val]['title']), $custom_widget[$val]['content'], $val);
		}
	}else{
		$callback = 'widget_'.$val;
		if(function_exists($callback))
		{
			preg_match("/^.*\s\((.*)\)/", $widget_title[$val], $matchs);
			$wgTitle = isset($matchs[1]) ? $matchs[1] : $widget_title[$val];
			call_user_func($callback, htmlspecialchars($wgTitle));
		}
	}
}
?>

</ul>
<ul>
<?php if(ISLOGIN): ?>
	<a href="<?php echo BLOG_URL; ?>admin/write_log.php">写日志</a>
	<a href="<?php echo BLOG_URL; ?>admin/">管理中心</a>
	<a href="<?php echo BLOG_URL; ?>admin/index.php?action=logout">退出</a>
<?php else: ?>
	<a href="<?php echo BLOG_URL; ?>admin/index.php">登录</a>
<?php endif; ?>
</ul>
</div>